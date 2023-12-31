<?php
    namespace App\controllers;
    use App\core\View;
    use App\Forms\UpdateUser;
    use App\models\User;
    use App\models\Page;
    use App\models\PageComment;
    use App\models\Reporting;
    use App\services\RedirectionService;

final class Admin {

    public function getUsers()
    {
        $user = new User();
        $users = $user->getAll(['is_deleted'=>0]);
        $view=new View("admin/dashboard");
        $view->assign('data', $users);
    }

    public function getPages()
    {
        $page = new Page();
        $pages = $page->getAll();
        $view=new View("admin/dashboardPages");
        $view->assign('data', $pages);
    }

    public function getReportings()
    {
        $report = new Reporting();
        $reports = $report->getAll(['status'=>Reporting::STATUS_ACTIVE]);
        $view=new View("admin/dashboardReports");
        $view->assign('data', $reports);
    }

    public function switchPageStatus()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $page = new Page();
            $page = $page->getOneBy(['id' => $id]);
            $newPageStatus = $page->isPageActive() ? 0 : 1;
            $page->setStatus($newPageStatus);
            $page = $page->save();
            RedirectionService::redirectTo("dashboard-pages");
        }
        else
        {
            die("Pas d'ID retourné");
        }
    }

    public function hardDeleteUser()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $user = new User();
            $user = $user->getOneBy(['id' => $id]);
            $user->setFirstname('firstname');
            $user->setLastname('lastname');
            $user->setEmail(User::HARD_DELETED_USER_EMAIL);
            $user->setIsDeleted(1);
            $user = $user->save();
            RedirectionService::redirectTo("dashboard");
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
            if($updateUserForm->isSubmited() && $updateUserForm->isValid()){
                var_dump($_POST);
                $user->setFirstname($_POST["firstname"]);
                $user->setLastname($_POST["lastname"]);
                $user->setEmail($_POST["email"]);
                $user->setStatus($_POST["status"]);
                $user->setRole($_POST["role"]);
                $user->save();
                RedirectionService::redirectTo("dashboard");
            }
            $view = new View("admin/updateUser");
            $view->assign('form', $updateUserForm->getConfig());
            $view->assign('formErrors', $updateUserForm->listOfErrors);
        }
        else
        {
            die("Il manque l'id dans l'urlParam");
        }
        

    }

    public function validateComment()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $reporting = new Reporting();
            $reporting = $reporting->getOneBy(['id' => $id]);
            $reporting->setStatus(Reporting::STATUS_REVIEWED);
            $reporting = $reporting->save();
            RedirectionService::redirectTo("dashboard-reportings");
        } else {
            die("Pas d'ID retourné");
        }
    }

    public function blockComment()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $reporting = new Reporting();
            $reporting = $reporting->getOneBy(['id' => $id]);
            $commentId = $reporting->getComment();
            $reporting->setStatus(Reporting::STATUS_REVIEWED);
            $reporting = $reporting->save();
            $comment = new PageComment();
            $comment = $comment->getOneBy(['id'=>$commentId]);
            $comment->setStatus(PageComment::STATUS_BANNED);
            $comment->save();
            RedirectionService::redirectTo("dashboard-reportings");
        } else {
            die("Pas d'ID retourné");
        }
    }

    public function componentDocumentation()
    {
        $view=new View("admin/componentDocumentation");
    }
}