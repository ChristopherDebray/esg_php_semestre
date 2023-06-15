<?php
    namespace App\controllers;
    use App\core\View;
    use App\Forms\UpdateUser;
    use App\models\User;

final class Admin {

    public function getUsers()
    {
        $user = new User();
        $users = $user->getAll();
        $view=new View("admin/dashboard");
        $view->assign('data', $users);
    }

    public function hardDeleteUser()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $user = new User();
            $user = $user->getOneBy(['id' => $id]);
            $user->setFirstname('firstname');
            $user->setLastname('lastname');
            $user->setEmail('email@mail.com');
            $user->setIsDeleted(1);
            $user = $user->save();
        }
        else
        {
            die("Pas d'ID retourné");
        }
    }

    public function softDeleteUser()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $user = new User();
            $user = $user->getOneBy(['id' => $id]);
            $user->setIsDeleted(1);
            $user = $user->save();
        }
        else
        {
            die("Pas d'ID retourné");
        }
    }

    public function updateUser()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $user = new User();
            $user = $user->getOneBy(['id' => $id]);
            $updateUserForm = new UpdateUser($user);
            $view = new View("admin/updateUser");
            $view->assign('form', $updateUserForm->getConfig());
            $view->assign('formErrors', $updateUserForm->listOfErrors);
        }
        else
        {
            die("Il manque l'id dans l'urlParam");
        }
        

    }
}