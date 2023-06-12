<?php
namespace App\controllers;
use App\core\View;
use App\Forms\Register;
use App\Forms\Login;
use App\models\User;
use App\core\ORM;
use App\Service\EntityManager\User\UserEntityManager;
use App\Service\EntityManager\BaseEntityManager;

final class Security
{
    private UserEntityManager $userEntityManager;

    public function __construct() {
        // $this->baseEntityManager = new BaseEntityManager();
        $this->userEntityManager = new UserEntityManager();
    }

    public function login()
    {
        $form = new Login();
        if($form->isSubmited() && $form->isValid()){
            $inputedPassword = $_POST["pwd"];
            $user = $this->userEntityManager->getOneBy("email", $_POST['email'], User::getTable());

            if (!$user) {
                $form->addError("Identifiant incorrect.");
            } else {
                $isPasswordCorrect = $form->isPasswordCorrect($inputedPassword, $user->pwd);
                if ($isPasswordCorrect) {
                    $_SESSION['user'] = get_object_vars($user);
                    echo "<pre>";
                    var_dump($_SESSION['user']);
                    echo "</pre>";
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
}