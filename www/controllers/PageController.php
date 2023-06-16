<?php
namespace App\controllers;

use App\core\View;
use App\Forms\Page as PageForm;
use App\models\Page;
use App\core\Logger;

final class PageController{
  public function create()
  {
    $form = new PageForm(1);

    if($form->isSubmited() && $form->isValid()){
      $page = new Page();
      $this->setPageValues($form, $page);
    }

    $view = new View("security/login", "account");
    $view->assign('form', $form->getConfig());
    $view->assign('formErrors', $form->listOfErrors);
  }

  public function update()
  {
    if(!array_key_exists('id', $_GET)) {
      die('Il faut indiquer un id de page');
    }
    $page = new Page();
    $page = $page::getOneBy(['id'=>$_GET['id']]);
    if(!$page) {
      die('Page inexistante');
    }
    $data = array_merge($page->getContentAsArray(), $page->getConfigAsArray());
    $data['title'] = $page->getTitle();
    $form = new PageForm($page->getTheme(), $data);

    if($form->isSubmited() && $form->isValid()){
      $this->setPageValues($form, $page);
      header("Refresh:0");
    }

    $view = new View("security/login", "account");
    $view->assign('form', $form->getConfig());
    $view->assign('formErrors', $form->listOfErrors);
  }

  public function displayPage(Page $page)
  {
    
  }

  private function setPageValues(PageForm $form, Page $page): void
  {
    $data = $form->getFormattedData($_POST);
    $page->setEntityValues($data, $page);
    $page->setSlug($data['title']);
    $page->setUser($_SESSION['id']);
    $page->setTheme(1);
    $page->save();
  }
}