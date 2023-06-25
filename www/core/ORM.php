<?php
namespace App\core;

abstract class ORM{

    private $table;
    private $pdo;

    public function __construct()
    {
        $this->table = self::getTable();
        $connectDb = ConnectDB::getInstance();
        $this->pdo = $connectDb->getPdo();
    }

    public static function getTable(): string
    {
        $classExploded = explode("\\", get_called_class());
        $table = end($classExploded);
        $table = preg_replace('/([A-Z])/', '_$1', $table);
        $table = strtolower(ltrim($table, '_'));

        return DB_PREFIX.$table;
    }

    public static function getOneBy($columns, array $relations = [])
    {
        $connectDb = ConnectDB::getInstance();
        $queryPrepared = $connectDb->getPdo()->prepare("SELECT * FROM ".self::getTable().
                            " WHERE 1 = 1 ".self::createSqlSearchString($columns));
        $queryPrepared->execute($columns);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $object = $queryPrepared->fetch();

        if ($object !== false && !empty($relations)) {
            foreach ($relations as $relation => $relatedEntityClass) {
                $relatedEntity = $relatedEntityClass::getOneBy(['id' => $object->{$relation.'_id'}]);
                $object->{'set'.$relation}($relatedEntity);
            }
        }

        return $object;
    }

    public static function getAll($columns = null, array $relations = [])
    {
        $searchString = $columns ? self::createSqlSearchString($columns): '';
        $connectDb = ConnectDB::getInstance();
        $queryPrepared = $connectDb->getPdo()->prepare("SELECT * FROM ".self::getTable()." WHERE 1 = 1 ".$searchString);

        if ($searchString === '') {
            $queryPrepared->execute();
        } else {
            $queryPrepared->execute($columns);
        }
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $objects = $queryPrepared->fetchAll();

        if (!empty($objects) && !empty($relations)) {
            foreach ($objects as $object) {
                foreach ($relations as $relation => $relatedEntityClass) {
                    $relatedEntity = $relatedEntityClass::getOneBy(['id' => $object->{$relation.'_id'}]);
                    $object->{'set'.$relation}($relatedEntity);
                }
            }
        }

        return $objects;
    }

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToDelete = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDelete);

        if($columns["id"] == -1){
            unset($columns["id"]);
            $queryPrepared = $this->pdo->prepare("INSERT INTO ".$this->table." ( ".implode(", ", array_keys($columns))." ) ".
                " VALUES (:".implode(",:", array_keys($columns)).")");
        } else {
            unset($columns["id"]);
            $sqlUpdate = [];
            foreach ($columns as $key=>$value){
                $sqlUpdate[]= $key."=:".$key;
            }

            $queryPrepared = $this->pdo->prepare("UPDATE ".$this->table.
                " SET ".implode(",", $sqlUpdate).
                " WHERE id=".$this->getId());
        }
        $queryPrepared->execute($columns);
    }

    public static function deleteBy($columns)
    {
        $connectDb = ConnectDB::getInstance();
        $queryPrepared = $connectDb->getPdo()->prepare("DELETE FROM ".self::getTable().
                            " WHERE 1 = 1 ".self::createSqlSearchString($columns));
        $queryPrepared->execute($columns);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $object = $queryPrepared->fetch();
        return $object;
    }

    public static function setEntityValues($values, $entity): void
    {
        foreach ($values as $key => $value) {
            $methodName = 'set'.$key;
            // check foreach element if the method exist (fore exemple in User entity, setFirstname exists but not setPassword-confirm)
            if (method_exists($entity, $methodName)) {
                $entity->$methodName($value);
            }
        }
    }

    private static function createSqlSearchString($columns): string
    {
        $sqlSearch = [];
        foreach ($columns as $key=>$value){
            $searchString = $key."=:".$key;
            $searchString = " AND ".$searchString;
            $sqlSearch[] = $searchString;
        }

        return implode("", $sqlSearch);
    }
}