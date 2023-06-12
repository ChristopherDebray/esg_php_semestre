<?php

namespace App\Service\EntityManager\User;

use App\Service\EntityManager\BaseEntityManager;
use App\models\User;

class UserEntityManager extends BaseEntityManager
{
  public function __construct()
  {
    $this->table = User::getTable();
    parent::__construct($this->table);
  }
}