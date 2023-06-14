<?php
    namespace App\controllers;
    use App\core\View;
    use App\models\User;

final class Admin {

    public function getUsers()
    {
        $user = new User();
        $users = $user->getAll();
        $view=new View("admin/dashboard");
        $view->assign('data', $users);


    }
}