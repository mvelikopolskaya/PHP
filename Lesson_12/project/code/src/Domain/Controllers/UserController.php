<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Exception;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\User;


class UserController {

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();
        $render = new Render();;
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

    public function actionSave(): string {
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
            throw new \Exception("The inputted data is incorrect");
        }
    }

    public function actionUpdate(): string {
        if(User::exists($_GET['id'])) {
            $user = new User();
            $user->setUserId($_GET['id']);
            $arrayData = [];
            if(isset($_GET['name']))
                $arrayData['user_name'] = $_GET['name'];
            if(isset($_GET['lastname'])) {
                $arrayData['user_lastname'] = $_GET['lastname'];
            }
            $user->updateUser($arrayData);
        }
        else {
            throw new \Exception("Requested user doesn't exist");
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
        if(User::exists($_GET['id'])) {
            User::deleteFromStorage($_GET['id']);
            $render = new Render();
            return $render->renderPage(
                'user-removed.twig', []
            );
        }
        else {
            throw new Exception("Requested user doesn't exist");
        }
    }
}