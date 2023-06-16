<?php
declare (strict_types = 1);

namespace App\Core;

use App\Core\Validator;
use App\Core\Router;

class Deploy
{
    private String $configFile = './conf.inc.php';

    public function confDB($dbParams){

        // Change config file
        $config = file_get_contents($this->configFile, false, null);

        foreach($dbParams as $key => $value){
            $config = preg_replace('#// define\("'.strtoupper($key).'", "(.*?)"\);#', 'define("'.strtoupper($key).'", "'.$value.'");', $config);

            define(strtoupper($key), $value);
        }
        file_put_contents($this->configFile, $config);

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
        $config = file_get_contents($this->configFile, false, null);
        $config = preg_replace('#define\("INSTALLED", "0"\);#', 'define("INSTALLED", "1");', $config);
        file_put_contents($this->configFile, $config);
    }
}
