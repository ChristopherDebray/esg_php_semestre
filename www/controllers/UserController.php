<?php
namespace App\controllers;
use App\core\View;

final class UserController{
  public function index()
  {
    $view = new View("pageListing", "back");
  }
}