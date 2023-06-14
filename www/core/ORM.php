<?php
namespace App\core;

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
    /**
     * @param int $id
     */
    public static function populate(int $id)
    {
        return self::getOneBy("id", $id);
    }

    public static function getOneBy($columns)
    {
        $sqlSearch = [];
        foreach ($columns as $key=>$value){
            $searchString = $key."=:".$key;
            $searchString = $key == array_key_last($columns) ? $searchString : $searchString." AND ";
            $sqlSearch[] = $searchString;
        }

        $connectDb = ConnectDB::getInstance();
        $queryPrepared = $connectDb->getPdo()->prepare("SELECT * FROM ".self::getTable().
                            " WHERE 1 = 1 AND ".implode("", $sqlSearch));
        $queryPrepared->execute($columns);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $objet = $queryPrepared->fetch();
        return $objet;
    }

    public static function getAll($table = null)
    {
        $table = $table ? $table : self::getTable();
        $connectDb = ConnectDB::getInstance();
        $queryPrepared = $connectDb->getPdo()->prepare("SELECT * FROM ".$table);
        $queryPrepared->execute();
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $objet = $queryPrepared->fetchAll();
        return $objet;
    }

    public function save():void
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

    public static function deleteOneBy($column, $value, $table)
    {
        $table = $table ? $table : self::getTable();
        $connectDb = new ConnectDB();
        $queryPrepared = $connectDb->getPdo()->prepare("DELETE FROM ".$table.
                            " WHERE ".$column."=:".$column);
        $queryPrepared->execute([$column=>$value]);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $objet = $queryPrepared->fetch();
        return $objet;
    }

    public static function setEntityValues($values, $entity)
    {
        foreach ($values as $key => $value) {
            $methodName = 'set'.$key;
            // check foreach element if the method exist (fore exemple in User entity, setFirstname exists but not setPassword-confirm)
            if (method_exists($entity, $methodName)) {
                $entity->$methodName($value);
            }
        }
    }
}