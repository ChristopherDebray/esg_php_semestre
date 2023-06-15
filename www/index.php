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


$uri = strtolower(trim($_SERVER["REQUEST_URI"], "/"));
$uri = empty($uri)?"default":$uri;


if(file_exists("routes.yml"))
{
    $router = Router::getInstance()->getRoute();
} else {
    die("Page 404 : Not found / ERROR #4");
}