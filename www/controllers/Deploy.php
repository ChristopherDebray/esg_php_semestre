<?php
namespace App\controllers;

use App\core\Deploy as DeployCore;
use App\core\Router;
use App\core\Security as CoreSecurity;
use App\core\View;
use App\Forms\deploy\DeployDb;
use App\Forms\deploy\DeployUser;
use App\models\User;
use App\services\MailerService;

final class Deploy
{
    private MailerService $mailerService;

    public function __construct()
    {
        $this->mailerService = new MailerService();
    }

    public function deployDb(): void
    {
        $form = new DeployDb();

        if($form->isSubmited() && $form->isValid()){
            $DeployCore = new DeployCore;

            try {
                $DeployCore->confDB($_POST);

                header('Location: /'.Router::getInstance()->getSlug('Deploy', 'deployUser'));
                exit;
            } catch (\PDOException $error) {
                $form->addError($error->getMessage());
            }
        }

        $view = new View("deploy/dbinfo", "back");
        $view->assign('form', $form->getConfig());
        $view->assign('formErrors', $form->listOfErrors);
    }

    public function deployUser(): void
    {
        $form = new DeployUser();

        if($form->isSubmited() && $form->isValid()){
            $newUser = new User();
            $newUser->setEntityValues($_POST, $newUser);
            $token = CoreSecurity::createToken();
            $newUser->setToken($token);
            $newUser->setStatus(1);
            $newUser->setRole('admin');
            $newUser->save();
            $mailContent = "<a href=http://localhost/confirm-user-inscription?token=".$token."&email=".$newUser->getEmail().">Valider mon compte</a>";
            $this->mailerService->sendEmail($newUser->getEmail(), 'Confirmation de compte', $mailContent);

            $DeployCore = new DeployCore;
            $DeployCore->finishDeployed();

            header('Location: /'.Router::getInstance()->getSlug('PageController', 'listPages'));
            exit;
        }

        $view = new View("deploy/userinfo", "back");
        $view->assign('form', $form->getConfig());
        $view->assign('formErrors', $form->listOfErrors);
    }
}