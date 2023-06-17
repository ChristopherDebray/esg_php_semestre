<?php
namespace App\controllers;

use App\core\View;
use App\Forms\Page as PageForm;
use App\models\Page;
use App\core\Logger;
use App\normalizer\PageNormalizer;

final class PageController{
  public function create()
  {
    $form = new PageForm(2);

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
    $wireframeName = 'wireframe'.$page->getTheme();
    $contentData = $page->getContentAsArray();
    $configData = $page->getConfigAsArray();


    $view = new View($wireframeName, 'wireframePage');
    $view->assign('config', $configData);
    $view->assign('title', $page->getTitle());

    $view->assign('dataBanner', PageNormalizer::getGroupContentDataByKey($contentData, 'banner'));
    $view->assign('dataFooter', PageNormalizer::getGroupContentDataByKey($contentData, 'footer'));
    if($page->getTheme() == 1) {
      $view->assign('dataSlideshow', PageNormalizer::getGroupContentDataByKey($contentData, 'slideshow'));
      $view->assign('dataCustomcard', PageNormalizer::getGroupContentDataByKey($contentData, 'cards'));
      $view->assign('dataQuote', PageNormalizer::getGroupContentDataByKey($contentData, 'quote'));
    } elseif($page->getTheme() == 2) {
      $view->assign('dataPost', PageNormalizer::getGroupContentDataByKey($contentData, 'posts'));
    }
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