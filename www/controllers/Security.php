<?php
namespace App\controllers;

use App\core\View;
use App\Forms\Register;
use App\Forms\Login;
use App\models\User;
use App\core\ORM;
use App\core\Security as CoreSecurity;
use App\services\MailerService;
use App\services\RedirectionService;
use App\core\Validator;

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
            if(!Validator::isValidEmail($_POST['email'])) {
                $form->addError('Veuillez envoyer une adresse mail valide.');
            } else {
                $inputedPassword = $_POST["pwd"];
                $user = $userEntity->getOneBy(["email"=>$_POST['email']]);
                if (!$user) {
                    $form->addError("Identifiant incorrect.");
                } elseif(!$user->getIsVerified()) {
                    $form->addError("Vous devez vérifier votre compte");
                } else {
                    $isPasswordCorrect = $form->isPasswordCorrect($inputedPassword, $user->getPwd());
                    if ($isPasswordCorrect) {
                        $token = CoreSecurity::createToken();
                        $user->setToken($token);
                        $user->save();
                        $_SESSION['token'] = $token;
                        $_SESSION['id'] = $user->getId();
                        $_SESSION['role'] = $user->getRole();
                        RedirectionService::redirectTo("pages-list");
                    }
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
            if($this->createUser()) {
                RedirectionService::redirectTo("se-connecter");
            }
        }

        $view = new View("security/register", "account");
        $view->assign('form', $form->getConfig());
        $view->assign('formErrors', $form->listOfErrors);
    }

    private function createUser(): bool
    {
        if(!Validator::isValidEmail($_POST['email'])) {
            $form->addError('Veuillez envoyer une adresse mail valide.');
            return false;
        } 

        if ($_POST['password-confirm'] !== $_POST['pwd']) {
            $form->addError('Le mot de passe et sa confirmation doivent être identique.');
            return false;
        }

        $newUser = new User();
        $isUserAlreadyExistant = $newUser::getOneBy(['email'=>$_POST['email']]);

        if($isUserAlreadyExistant) {
            $form->addError('Cet email est déjà utilisé');
            return false;
        }

        $newUser->setEntityValues($_POST, $newUser);
        $token = CoreSecurity::createToken();
        $newUser->setToken($token);
        $newUser->save();
        $mailContent = "<a href=http://localhost/confirm-user-inscription?token=".$token."&email=".$newUser->getEmail().">Valider mon compte</a>";
        $this->mailerService->sendEmail($newUser->getEmail(), 'Confirmation de compte', $mailContent);
        return true;
    }

    public function logout()
    {
        session_destroy();
        RedirectionService::redirectTo('se-connecter');
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
}