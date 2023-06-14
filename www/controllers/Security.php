<?php
namespace App\controllers;

use App\core\View;
use App\Forms\Register;
use App\Forms\Login;
use App\models\User;
use App\core\ORM;
use App\services\MailerService;
use App\services\RedirectionService;

final class Security
{
    private MailerService $mailerService;

    public function __construct()
    {
        $this->mailerService = new MailerService();
    }

    public function login()
    {
        $userEntity = new User();
        $form = new Login();

        if($form->isSubmited() && $form->isValid()){
            $inputedPassword = $_POST["pwd"];
            $user = $userEntity->getOneBy(["email"=>$_POST['email']]);
            if (!$user) {
                $form->addError("Identifiant incorrect.");
            } elseif(!$user->getIsVerified()) {
                $form->addError("Vous devez vérifier votre compte");
            } else {
                $isPasswordCorrect = $form->isPasswordCorrect($inputedPassword, $user->getPwd());
                if ($isPasswordCorrect) {
                    $token = $this->createToken();
                    $user->setToken($token);
                    $user->save();
                    $_SESSION['token'] = $token;
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['role'] = $user->getRole();
                    RedirectionService::redirectTo("dashboard");
                }
            }
        }

        $view = new View("security/login", "account");
        $view->assign('form', $form->getConfig());
        $view->assign('formErrors', $form->listOfErrors);
    }

    public function register()
    {
        $form = new Register();
        if($form->isSubmited() && $form->isValid()){
            $newUser = new User();
            $newUser->setEntityValues($_POST, $newUser);
            $token = $this->createToken();
            $newUser->setToken($token);
            $newUser->save();
            $mailContent = "<a href=http://localhost/confirm-user-inscription?token=".$token."&email=".$newUser->getEmail().">Valider mon compte</a>";
            $this->mailerService->sendEmail($newUser->getEmail(), 'Confirmation de compte', $mailContent);
            RedirectionService::redirectTo("se-connecter");
        }

        $view = new View("security/register", "account");
        $view->assign('form', $form->getConfig());
        $view->assign('formErrors', $form->listOfErrors);
    }

    public function logout()
    {
        session_destroy();
        RedirectionService::redirectTo('se-connecter');
        die('test');
    }

    public function confirmUserEmail()
    {
        $user = new User();
        $user = $user::getOneBy(['token' => $_GET['token'], 'email'=>$_GET['email']]);
        $user->setStatus(User::STATUS_ACTIVE);
        $user->setIsVerified(1);
        $user->save();
        RedirectionService::redirectTo('se-connecter');
    }

    private function createToken() {
        $token = md5(uniqid()."jq2à,?".time());
        $token = substr($token, 0, rand(10,20));
        $token = str_shuffle($token);
        return $token;
    }
}