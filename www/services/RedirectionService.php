<?php
namespace App\services;

final class RedirectionService
{
  static $instance = null;

  private function __construct() {}

  public static function redirectTo($route, $params = null)
  {
    $basePath = "http://localhost/";
    $redirection = $basePath.$route;
    header("Location: ".$redirection);
  }

  public static function getInstance()
  {  
    if(is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}