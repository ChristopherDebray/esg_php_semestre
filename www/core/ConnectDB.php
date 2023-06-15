<?php

namespace App\core;

final class ConnectDB
{
    private $pdo;
    static $instance = null;

    private function __construct(){
        try{
            $this->pdo = new \PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
        }catch (\Exception $e){
            return false;
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}