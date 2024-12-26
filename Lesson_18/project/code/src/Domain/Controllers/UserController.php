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
        'actionIndex' => ['admin', 'user'],
        'actionShow' => ['admin', 'user'],
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
                    'users' => $users,
                    'isAdmin' => User::isAdmin($_SESSION['id_user'] ?? null)
                ]);
        }
    }

    public function actionSave() {
        $render = new Render();
        if(User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            if($user->existsWithLogin($user->getUserLogin())) {
                return $render->renderPage(
                    'user-created.twig', 
                    [
                        'title' => 'User exists',
                        'message' => "User {$user->getUserName()} already exists" 
                    ]);
            }
            else {
                $user->saveToStorage();
                return $render->renderPage(
                'user-created.twig', 
                [
                    'title' => 'User was created',
                    'message' => "User was created " . $user->getUserName() . " " . $user->getUserLastName()
                ]);
                }
            }
            
        else {
            throw new Exception("The inputted data is incorrect");
        }
    }

    public function actionUpdate(): string {
        $user_id = (int)$_GET['id'];
        if(User::exists($user_id)) {
            $user = User::getUserById($user_id);
            $arrayData = [];
            if(isset($_POST['login']))
                $arrayData['login'] = $_POST['login'];
            if(isset($_POST['name']))
                $arrayData['user_name'] = $_POST['name'];
            if(isset($_POST['lastname'])) {
                $arrayData['user_lastname'] = $_POST['lastname'];
            }
            if(isset($_POST['birthday'])) {
                $arrayData['user_birthday_timestamp'] = $_POST['birthday'];
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
                'message' => "The user with id {$user->getUserId()} get updated "
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

    public function actionUpdateData() {
        $render = new Render();
        $user_id = (int)$_GET['id'];
        if(User::exists($user_id)){
            $user = User::getUserById($user_id);
        }
        return $render->renderPageWithForm(
                'user-update.twig', 
                [
                    'title' => "User's update form",
                    'user' => $user
                ]);
    }

    public function actionEdit(): string {
        $render = new Render();
        return $render->renderPageWithForm(
                'user-form.twig', 
                [
                    'title' => "User's form"
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
                    'title' => 'Login',
                    'auth_success' => true
                ]);
    }

    public function actionLogin(): string {
        $result = false;
        $render = new Render();
        if(isset($_POST['login']) && isset($_POST['password'])){
            $result = Application::$auth->proceedAuth($_POST['login'], $_POST['password']);
        }
        if($result){
            if(isset($_POST['user-remember']) && ($_POST['user-remember'] == 'remember')) {
                $token = Application::$auth->generateToken();
                User::setToken($_SESSION['id_user'], $token);
            }
            header('Location: /');
            return "";
        }
        else {
            return $render->renderPageWithForm(
                'user-auth.twig', 
                [
                    'title' => 'Login',
                    'auth_success' => false,
                    'auth_error' => 'Wrong login or password'
                ]);
        }
    }

    public function actionLogout() {
        session_destroy();
        User::destroyToken();
        unset($_SESSION['user_name']);
        header("Location: /");
        die();
    }

    public function actionIndexRefresh(){
        $limit = null;
        if(isset($_POST['maxId']) && ($_POST['maxId'] > 0)) {
            $limit = (int)$_POST['maxId'];
        }
        $users = User::getAllUsersFromStorage($limit);
        $userData = [];
        if(count($users) > 0) {
            foreach($users as $user) {
                $userData[] = $user->getUserDataArray();
            }
        }
        return json_encode($userData);
    }
}