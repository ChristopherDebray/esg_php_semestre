<?php
namespace App\core;

use App\core\Logger;

abstract class ORM{

    private $table;
    private $pdo;

    public function __construct($table = null)
    {
        $this->table = $table ? $table : self::getTable();
        $connectDb = ConnectDB::getInstance();
        $this->pdo = $connectDb->getPdo();
    }

    public static function getTable(): string
    {
        $classExploded = explode("\\", get_called_class());
        return DB_PREFIX.strtolower(end($classExploded));
    }

    public static function getOneBy($columns)
    {
        $connectDb = ConnectDB::getInstance();
        $queryPrepared = $connectDb->getPdo()->prepare("SELECT * FROM ".self::getTable().
                            " WHERE 1 = 1 ".self::createSqlSearchString($columns));
        $queryPrepared->execute($columns);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $objet = $queryPrepared->fetch();
        return $objet;
    }

    public static function getAll($columns = null)
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
        $objet = $queryPrepared->fetchAll();
        return $objet;
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
        $objet = $queryPrepared->fetch();
        return $objet;
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
            $searchString = "AND ".$searchString;
            $sqlSearch[] = $searchString;
        }

        return implode("", $sqlSearch);
    }
}