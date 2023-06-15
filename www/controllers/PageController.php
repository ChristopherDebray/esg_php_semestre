<?php
namespace App\controllers;

use App\core\View;
use App\Forms\Page as PageForm;
use App\models\Page;
use App\core\Logger;

final class PageController{
  public function create()
  {
    $form = new PageForm();

    if($form->isSubmited() && $form->isValid()){
      $data = $form->getFormattedData($_POST);
      // echo "<pre>";
      // var_dump(json_encode($data['content']));
      // echo "</pre>";
      $page = new Page();
      $page->setTitle($data['title']);
      $page->setSlug($data['title']);
      $page->setContent(json_encode($data['content']));
      $page->setConfig(json_encode($data['config']));
      $page->setTheme(1);
      $page->save();
    }

    $view = new View("security/login", "account");
    $view->assign('form', $form->getConfig());
    $view->assign('formErrors', $form->listOfErrors);
  }
}