<?php

namespace App\core;

final class Logger
{
  static $instance = null;

  public static function logData($data)
  {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
  }

  public static function logDataWithHTML($data)
  {
    echo "<pre>";
    $formattedData = gettype($data) == "array" ? array_map('htmlspecialchars', $data) : htmlspecialchars($data);
    var_dump($formattedData);
    echo "</pre>";
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