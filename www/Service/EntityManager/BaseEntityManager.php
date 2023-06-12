<?php

namespace App\Service\EntityManager;

use App\core\Orm;

class BaseEntityManager extends ORM
{
  public function __construct($table)
  {
    parent::__construct($table);
  }
}