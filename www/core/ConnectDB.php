<?php

namespace App\core;

final class ConnectDB
{
    private $pdo;
    public function __construct(){
        try{
            $this->pdo = new \PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
        }catch (\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}