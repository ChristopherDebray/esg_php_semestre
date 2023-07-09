<?php
namespace App\core;

use App\core\ConnectDB;
use App\core\Validator;
use App\core\Router;
use App\core\DotEnv;

class Deploy
{
    public function confDB($dbParams){
        foreach($dbParams as $key => $value){
            (new DotEnv(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ".env"))->setenv($key, $value);
        }

        // Install datas
        $connectDb = ConnectDB::getInstance();
        
        if (is_null($connectDb->getPdo())) {
            throw new \PDOException('Impossible de se connecter à la base de données.');
        }

        $sql = file_get_contents('./dump.sql', false, null);

        try{
            $pdo = $connectDb->getPdo();
            $pdo->exec($sql);
            throw new \PDOException('Impossible d\'importer la base de données.');
        }catch(\PDOException $e){
            throw new \PDOException('ERROR : '.$e->getMessage());
        }
    }

    public function finishDeployed(): void
    {
        (new DotEnv(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ".env"))->setenv("INSTALLED", 1);
    }
}
