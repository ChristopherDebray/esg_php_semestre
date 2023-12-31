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
    return Router::error404("Page introuvable / ERROR &6H&76C");
}
