<?php
namespace App;

use App\core\Router;

session_start();
require "conf.inc.php";
require './vendor/autoload.php';

spl_autoload_register(function ($class)
{
    $class = str_ireplace("App\\", "", $class);
    $class = str_replace("\\", "/", $class);
    if( file_exists($class.".php")){
        include $class.".php";
    }
});

if(file_exists("routes.yml"))
{
    $router = Router::getInstance()->getRoute();
} else {
    die("Page 404 : Not found / ERROR #4");
}

// $router = Router::getInstance()->getRoute($uri);

/*
$routes  = yaml_parse_file("routes.yml");

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

$controller = new ($namespaceController.$c)(); //new Front();

//Sinon appel de l'action
if(!method_exists($controller, $a)){
    die("La méthode ".$a." n'existe pas");
}

//Front->contact();
$controller->$a();

*/
