<?php
namespace App\controllers;

use App\core\View;
use App\core\ConnectDB;

final class Front{
    public function home()
    {
        $pseudo = "Prof";
        $view = new View("main/homepage", "back");
        $view->assign("pseudo", $pseudo);
        $view->assign("lastname", "SKZYPCZYK");
    }

    public function contact()
    {
        die("Voici ma nouvelle page de contact");
    }

    public function sitemap()
    {
        $data = [];
        $urls = [];

        $connectDb = ConnectDB::getInstance();
        $queryPrepared = $connectDb->getPdo()->prepare('SELECT slug FROM '.DB_PREFIX.'page');
        $queryPrepared->execute();
        $queryPrepared->setFetchMode(\PDO::FETCH_ASSOC);
        $objet = $queryPrepared->fetchAll();

        foreach ($objet as $r) {
            foreach ($r as $key => $value) {
                $data[] = $value;
            }
        }

        $_yml = yaml_parse_file("./routes.yml");

        foreach ($_yml as $key => $value) {
            if (!isset($value['permission'])) $urls[] = $key;
        }

        $allUrls = array_merge($urls, $data);
        $view = new View('main/sitemap', 'xml');
        $view->assign('data', $allUrls);
    }
}