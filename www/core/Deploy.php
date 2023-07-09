<?php
namespace App\Core;

use App\Core\Validator;
use App\Core\Router;
use App\core\DotEnv;

class Deploy
{
    public function confDB($dbParams){
        foreach($dbParams as $key => $value){
            (new DotEnv(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ".env"))->setenv($key, $value);
        }

        // Install datas
        $connectDb = ConnectDB::getInstance();
        $sql = file_get_contents('./dump.sql', false, null);

        if (is_null($connectDb->getPdo())) {
            throw new \PDOException('Impossible de se connecter à la base de données.');
        }

        try{
            $pdo = $connectDb->getPdo();
            $pdo->exec($sql);
            return true;
        }catch(\PDOException $e){
            var_dump($e);
            die("error db");
            return false;
        }
    }

    public function finishDeployed(): void
    {
        (new DotEnv(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ".env"))->setenv("INSTALLED", 1);
    }
}
