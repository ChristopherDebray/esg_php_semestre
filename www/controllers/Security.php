<?php
namespace App\controllers;
use App\core\View;
use App\Forms\Register;
use App\Forms\Login;
use App\models\User;
use App\core\ORM;

final class Security
{
    public function login()
    {
        $userEntity = new User();
        $form = new Login();

        if($form->isSubmited() && $form->isValid()){
            $inputedPassword = $_POST["pwd"];
            $user = $userEntity->getOneBy("email", $_POST['email']);

            if (!$user) {
                $form->addError("Identifiant incorrect.");
            } else {
                $isPasswordCorrect = $form->isPasswordCorrect($inputedPassword, $user->getPwd());
                if ($isPasswordCorrect) {
                    $token = $this->createToken();
                    $user->setToken($token);
                    $user->save();
                    $_SESSION['token'] = $token;
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['role'] = $user->getRole();
                }
            }
        }

        $view = new View("security/login", "account");
        $view->assign('form', $form->getConfig());
        $view->assign('formErrors', $form->listOfErrors);
    }

    public function register()
    {
        /*
        $user = User::populate(4);
        $user->setPwd("toto");
        $user->save();

        $this->userEntityManager->deleteOneBy("id", "4", User::getTable());
        $this->userEntityManager->getAll(User::getTable());
        */
        $form = new Register();
        if($form->isSubmited() && $form->isValid()){
            $newUser = new User();
            $newUser->setEntityValues($_POST, $newUser);
            $newUser->setStatus(1);
            $newUser->save();
        }

        $view = new View("security/register", "account");
        $view->assign('form', $form->getConfig());
        $view->assign('formErrors', $form->listOfErrors);
    }

    public function logout()
    {
        die("logout");
    }

    private function createToken() {
        $token = md5(uniqid()."jq2à,?".time());
        $token = substr($token, 0, rand(10,20));
        $token = str_shuffle($token);
        return $token;
    }
}