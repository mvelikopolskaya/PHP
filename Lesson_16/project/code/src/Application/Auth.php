<?php

namespace Geekbrains\Application1\Application;

use Geekbrains\Application1\Domain\Models\User;

class Auth {
    public static function getPasswordHash(string $rawPassword): string {
        return password_hash($rawPassword, PASSWORD_BCRYPT);
    }

    public function proceedAuth(string $login, string $password): bool{
        $sql = "SELECT id_user, user_name, user_lastname, password_hash FROM users WHERE login = :login";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['login' => $login]);
        $result = $handler->fetchAll();

        if(!empty($result) && password_verify($password, $result[0]['password_hash'])){
            $_SESSION['user_name'] = $result[0]['user_name'];
            $_SESSION['user_lastname'] = $result[0]['user_lastname'];
            $_SESSION['id_user'] = $result[0]['id_user'];
            return true;
        }
        else {
            return false;
        }
    }

    public function generateToken() {
        $bytes = random_bytes(16);
        return bin2hex($bytes);
    }

    public function restoreSession() {
        if(isset($_COOKIE['auth_token']) && !isset($_SESSION['user_name'])) {
            $userData = User::verifyToken($_COOKIE['auth_token']);

            if(!empty($userData)){
                $_SESSION['user_name'] = $userData['user_name'];
                $_SESSION['user_lastname'] = $userData['user_lastname'];
                $_SESSION['id_user'] = $userData['id_user'];

            }
        }
        
    }
}