<?php

namespace App\core;

use App\core\Security;

final class Router
{
    private static $_instance = null;

    public static function getInstance($uri) {
        if(is_null(self::$_instance)) {
            self::$_instance = new self($uri);  
        }
        return self::$_instance;
    }

    private function __construct($uri)
    {
        $routes  = yaml_parse_file("./routes.yml");
        $uri = explode('?', $uri)[0];

        //Si l'uri n'existe pas dans $routes die page 404
        if(empty($routes[$uri])){
            die("Page 404 : Not found");
        }
        //Sinon si l'uri ne possède pas de controller ni d'action die erreur fichier routes.yml
        if(empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"])){
            die("Erreur fichier routes.yml pour : ".$uri);
        }

        $c = $routes[$uri]["controller"]; //Security
        $a = $routes[$uri]["action"]; //login
        $p = $routes[$uri]["permission"] ?? null; // Admin

        //Sinon si il n'y a pas de fichier controller correspondant die absence du fichier controller
        if(!file_exists("controllers/".$c.".php")){
            die("Le fichier "."controllers/".$c.".php"." n'existe pas");
        }

        //Sinon si l'action n'existe pas die action inexistante
        include "controllers/".$c.".php";
        $namespaceController = "App\controllers\\";
        if(!class_exists($namespaceController.$c)){
            die("La classe ".$c." n'existe pas");
        }


        if ($p && !Security::hasRole($p)) {
            die("qmezlrjk");
        }
        /** @TODO add the singleton principle to the controller call and if possible to the action */
        $controller = new ($namespaceController.$c)(); //new Front();

        //Sinon appel de l'action
        if(!method_exists($controller, $a)){
            die("La méthode ".$a." n'existe pas");
        }

        //Front->contact();
        return $controller->$a();
    }
}