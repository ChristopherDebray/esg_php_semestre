<?php
namespace App\core;

use App\core\DotEnv;

final class ConnectDB
{
    private $pdo;
    static $instance = null;

    private function __construct(){
        (new DotEnv(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ".env"))->load();

        $conn = $_ENV['DB_DRIVER'].":host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'].";port=".$_ENV['DB_PORT'];
        $options = array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->pdo = new \PDO($conn, $_ENV['DB_USER'], $_ENV['DB_PWD'], $options);
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