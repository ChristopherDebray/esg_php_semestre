<?php
namespace App\controllers;

use App\core\View;
use App\Forms\Page as PageForm;
use App\Forms\PageComment as PageCommentForm;
use App\models\Page;
use App\models\PageComment;
use App\models\User;
use App\core\Security;
use App\core\Logger;
use App\normalizer\PageNormalizer;
use App\models\Reporting;
use App\services\RedirectionService;

final class PageController{
  public function create()
  {
    if(!array_key_exists('wireframe', $_GET)) {
      die('Il faut indiquer un type de page valide');
    }
    $pageTheme = $_GET['wireframe'];
    $form = new PageForm($pageTheme);

    if($form->isSubmited() && $form->isValid()){
      $page = new Page();
      $pageSlug = $page->generateSlug($_POST['title']);
      $pageExists = $page::getOneBy(['slug' => $pageSlug]);
      $page->setTheme($pageTheme);
      
      if ($pageExists) {
        $form->addError('Une page avec ce titre existe déjà.');
      } else {
        $this->setPageValues($form, $page);
      }
    }

    $view = new View("page/create_update", "account");
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
      $pageSlug = $page->generateSlug($_POST['title']);
      
      if ($pageSlug !== $page->getSlug()) {
        $pageExists = $page::getOneBy(['slug' => $pageSlug]);
        if ($pageExists) {
          $form->addError('Une page avec ce titre existe déjà.');
        } else {
          $this->setPageValues($form, $page);
          header("Refresh:0");
        }
      } else {
        $this->setPageValues($form, $page);
        header("Refresh:0");
      }
    }

    $view = new View("page/create_update", "account");
    $view->assign('form', $form->getConfig());
    $view->assign('pageTheme', $page->getTheme());
    $view->assign('formErrors', $form->listOfErrors);
  }

  public function displayPage(Page $page)
  {
    $wireframeName = 'wireframe'.$page->getTheme();
    $contentData = $page->getContentAsArray();
    $configData = $page->getConfigAsArray();

    $view = new View($wireframeName, 'wireframePage');
    $pageComment = new PageComment();

    if (Security::isConnected()) {
      $form = new PageCommentForm();
      if($form->isSubmited() && $form->isValid()){
        $pageComment->setContent($_POST['content']);
        $pageComment->setPage($page->getId());
        $pageComment->setUser($_SESSION['id']);
        $pageComment->save();
      }
  
      $view->assign('form', $form->getConfig());
      $view->assign('formErrors', $form->listOfErrors);
    }

    $pageCommentRelations = [
      'user' => User::class,
      'page' => Page::class,
    ];
    $pageComments = $pageComment::getAll(['page_id' => $page->getId(), 'status' => PageComment::STATUS_ACTIVE], $pageCommentRelations);

    $view->assign('comments', $pageComments);

    $view->assign('config', $configData);
    $view->assign('title', $page->getTitle());

    $view->assign('dataBanner', PageNormalizer::normalize($contentData, 'banner'));
    $view->assign('dataFooter', PageNormalizer::normalize($contentData, 'footer'));
    if($page->getTheme() == 1) {
      $view->assign('dataSlideshow', PageNormalizer::normalize($contentData, 'slideshow'));
      $view->assign('dataCustomcard', PageNormalizer::normalize($contentData, 'cards'));
      $view->assign('dataQuote', PageNormalizer::normalize($contentData, 'quote'));
    } elseif($page->getTheme() == 2) {
      $view->assign('dataPost', PageNormalizer::normalize($contentData, 'posts'));
    } else {
      $view->assign('dataArticle', PageNormalizer::normalize($contentData, 'article'));
      $view->assign('dataVideo', PageNormalizer::normalize($contentData, 'video'));
      $view->assign('dataWysiwyg', PageNormalizer::normalize($contentData, 'wysiwyg'));
    }
  }

  private function setPageValues(PageForm $form, Page $page): void
  {
    $data = $form->getFormattedData($_POST);
    $page->setEntityValues($data, $page);
    $page->setSlug($data['title']);
    $page->setUser($_SESSION['id']);
    $page->save();
  }

  public function signalComment(): void
  {
    $signalment = new Reporting();
    $signalment->setComment($_GET['id']);
    $signalment->save();
    RedirectionService::redirectTo($_GET['page']);

  }

  public function listPages()
  {
    $page = new Page();
    $pages = $page->getAll();
    $view=new View("main/pageListing", "front");
    $view->assign('data', $pages);
  }
}