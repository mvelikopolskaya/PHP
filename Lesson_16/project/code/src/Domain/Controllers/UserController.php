<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Exception;
use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Application\Auth;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\User;



class UserController extends AbstractController {
    protected array $actionsPermissions = [
        'actionHash' => ['admin'],
        'actionSave' => ['admin'],
        'actionEdit' => ['admin'],
        'actionIndex' => ['admin'],
        'actionLogout' => ['admin'],
        'actionCreate' => ['admin'],
        'actionDelete' => ['admin'],
        'actionUpdate' => ['admin']
    ];

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();
        $render = new Render();
        if (!$users) {
            return $render->renderPage(
                'user-empty.twig', 
                [
                    'title' => "User's list in the storage",
                    'message' => "The list is empty or not found"
                ]);
        }
        else {
            return $render->renderPage(
                'user-index.twig', 
                [
                    'title' => "User's list in the storage",
                    'users' => $users
                ]);
        }
    }

    public function actionSave() {
        if(User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            $user->saveToStorage();
            $render = new Render();
            return $render->renderPage(
                'user-created.twig', 
                [
                    'title' => 'User was created',
                    'message' => "User was created " . $user->getUserName() . " " . $user->getUserLastName()
                ]);
        }
        else {
            throw new Exception("The inputted data is incorrect");
        }
    }

    public function actionUpdate(): string {
        if(User::exists($_POST['user_id'])) {
            $user = new User();
            $user->setUserId($_POST['user_id']);
            $arrayData = [];
            if(isset($_POST['name']))
                $arrayData['user_name'] = $_POST['name'];
            if(isset($_POST['lastname'])) {
                $arrayData['user_lastname'] = $_POST['lastname'];
            }
            $user->updateUser($arrayData);
        }
        else {
            throw new Exception("Requested user doesn't exist");
        }
        $render = new Render();
        return $render->renderPage(
            'user-created.twig', 
            [
                'title' => 'The user get updated',
                'message' => "The user get updated " . $user->getUserId()
            ]);
    }

    public function actionDelete(): string {
        $user_id = (int)$_GET['id'];
        if(User::exists($user_id)) {
            User::deleteFromStorage($user_id);
            $render = new Render();
            return $render->renderPage(
                'user-removed.twig', []
            );
        }
        else {
            throw new Exception("Requested user doesn't exist");
        }
    }

    function actionShow() {
        $user_id = (int)$_GET['id'];
        if(User::exists($user_id)) {
            $user = User::getUserById($user_id);
            $render = new Render();
            return $render->renderPage(
                'user-page.twig', [
                    'user' => $user
                ]
            );
        }
        else {
            throw new Exception("Requested user doesn't exist");
        }
    }

    public function actionEdit(): string {
        $render = new Render();
        $userData = [];
        $action = "user/save";
        if(isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];
            $action = 'user/update';
            $userDate = User::getUserById($userId);
        }
        return $render->renderPageWithForm(
                'user-form.twig', 
                [
                    'title' => 'User creation form',
                    'user_data' => $userData[0] ?? [],
                    'action' => $action
                ]);
    }

    public function actionHash(): string {
        return Auth::getPasswordHash($_GET['pass_string']);
    }

    public function actionAuth(): string {
        $render = new Render();
        return $render->renderPageWithForm(
                'user-auth.twig', 
                [
                    'title' => 'Login'
                ]);
    }

    public function actionLogin(): string {
        $result = false;
        if(isset($_POST['login']) && isset($_POST['password'])){
            $result = Application::$auth->proceedAuth($_POST['login'], $_POST['password']);
        }
        if(!$result){
            $render = new Render();
            return $render->renderPageWithForm(
                'user-auth.twig', 
                [
                    'title' => 'Login',
                    'auth-success' => false,
                    'auth-error' => 'Wrong login or password'
                ]);
        }
        else{
            header('Location: /');
            return "";
        }
    }

    public function actionLogout() {
        session_destroy();
        unset($_SESSION['user_name']);
        header("Location: /");
        die();
    }
}