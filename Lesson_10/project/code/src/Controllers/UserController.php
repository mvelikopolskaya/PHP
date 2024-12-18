<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;
use Geekbrains\Application1\Models\Validator;

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

    public function actionSave() {
        $validator = new Validator();
        $address = "./storage/birthdays.txt";
        $name = $_GET['name'];
        $date = $_GET['birthday'];
        if($validator->validateDate($date) && $validator->validateName($name)) {
            $data = $name . ", " . $date . PHP_EOL;
            $fileHandler = fopen($address, 'a');
            if (fwrite($fileHandler, $data)) {
                fclose($fileHandler);
                return "Entry $data added into the file $address";
            }
            else {
                fclose($fileHandler);
            }
        } 
        else {
            return "Entry error. Data is not saved.";
        }
    }
}