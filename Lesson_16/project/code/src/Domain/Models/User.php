<?php

namespace Geekbrains\Application1\Domain\Models;

use Geekbrains\Application1\Application\Application;


class User {

    private ?int $idUser;

    private ?string $userName;

    private ?string $userLastName;
    private ?int $userBirthday;
    private ?string $userLogin;


    public function __construct(string $name = null, string $lastName = null, int $birthday = null, int $id_user = null, string $login = null){
        $this->userName = $name;
        $this->userLastName = $lastName;
        $this->userBirthday = $birthday;
        $this->idUser = $id_user;
        $this->userLogin = $login;
    }

    public function setUserId(int $id_user): void {
        $this->idUser = $id_user;
    }

    public function getUserId(): ?int {
        return $this->idUser;
    }

    public function setName(string $userName) : void {
        $this->userName = $userName;
    }

    public function setLastName(string $userLastName) : void {
        $this->userLastName = $userLastName;
    }

    public function setLogin(string $userLogin) : void {
        $this->userLogin = $userLogin;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserLastName(): string {
        return $this->userLastName;
    }

    public function getUserBirthday(): int {
        return $this->userBirthday;
    }

    public function setBirthdayFromString(string $birthdayString) : void {
        $this->userBirthday = strtotime($birthdayString);
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public static function setToken(int $id, string $token){
        $sql = "UPDATE users SET token = :token WHERE id_user = :id";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id' => $id, 'token' => $token]);
        setcookie('auth_token', $token, time() +36000, '/');
    }

    public static function verifyToken(string $token) {
        $sql = "SELECT * FROM users WHERE token = :token";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['token' => $token]);
        $result = $handler->fetchAll();
        return $result[0] ?? [];
    }

    public static function destroyToken() {
        $sql = "UPDATE users SET token = :token WHERE id_user = :id";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['token' => md5(bin2hex(random_bytes(16))), 'id' => $_SESSION['id_user']]);
        $result = $handler->fetchAll();
        return $result[0] ?? [];
    }

    public static function getAllUsersFromStorage(): array {
        $sql = "SELECT * FROM users";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();
        $result = $handler->fetchAll();

        $users = [];

        foreach($result as $item){
            $user = new User($item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp'], $item['id_user']);
            $users[] = $user;
        }
        
        return $users;
    }

    public static function validateRequestData(): bool{
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $login = $_POST['login'];
        $birthday = $_POST['birthday'];
        $patternDate = '/^(\d{2}-\d{2}-\d{4})$/';
        $patternNotHTML = '/<([^>]+)>/';
        $result = true;
        if(!(
            isset($name) && !empty($name) &&
            isset($lastname) && !empty($lastname) &&
            isset($birthday) && !empty($birthday)
        )) {
            $result = false;
        }
        else {
            if(!preg_match($patternDate, $birthday)){
            $result =  false;
            }

            if(
                preg_match($patternNotHTML, $login) 
                || preg_match($patternNotHTML, $name) 
                || preg_match($patternNotHTML, $lastname)
            ) {
                $result =  false;
            }
            
            if(!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
            $result = false;
            }
        }
        return $result;
    }

    public function setParamsFromRequestData(): void {
        $this->userName = htmlspecialchars($_POST['name']);
        $this->userLastName = htmlspecialchars($_POST['lastname']);
        $this->setBirthdayFromString($_POST['birthday']);
        $this->userLogin = htmlspecialchars($_POST['login']);
    }

    public function saveToStorage(){
        $sql = "INSERT INTO users(user_name, user_lastname, user_birthday_timestamp, login) VALUES (:user_name, :user_lastname, :user_birthday, :user_login)";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'user_name' => $this->userName,
            'user_lastname' => $this->userLastName,
            'user_birthday' => $this->userBirthday,
            'user_login' => $this->userLogin,
        ]);
    }

    public static function exists(int $id): bool{
        $sql = "SELECT count(id_user) as user_count FROM users WHERE id_user = :id_user";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'id_user' => $id
        ]);

        $result = $handler->fetchAll();

        if(count($result) > 0 && $result[0]['user_count'] > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public static function existsWithLogin(string $login): bool{
        $sql = "SELECT count(id_user) as user_count FROM users WHERE login = :login";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'login' => $login
        ]);

        $result = $handler->fetchAll();

        if(count($result) > 0 && $result[0]['user_count'] > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function updateUser(array $userDataArray): void{
        $sql = "UPDATE users SET ";
        $counter = 0;
        foreach($userDataArray as $key => $value) {
            $sql .= $key ." = :".$key;
            if($counter != count($userDataArray)-1) {
                $sql .= ",";
            }
            $counter++;
        }
        $sql .= " WHERE id_user = " . $this->getUserId();
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute($userDataArray);
    }

    public static function deleteFromStorage(int $user_id) : void {
        $sql = "DELETE FROM users WHERE id_user = :id_user";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id_user' => $user_id]);
    }

    public static function getUserById(int $id) : User {
        $sql = "SELECT * FROM users WHERE id_user = :id";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id' => $id]);
        $result = $handler->fetch();
        return new User(
            $result["user_name"], 
            $result["user_lastname"], 
            $result["user_birthday_timestamp"], 
            $result['id_user'],
            $result['login']);

    }

    public function getUserRoleByID() {
        $roles[] = 'user';
        if(isset($_SESSION['id_user'])){
            $rolesSql = "SELECT * FROM user_roles WHERE id_user = :id";
            $handler = Application::$storage->get()->prepare($rolesSql);
            $handler->execute(['id' => $_SESSION['id_user']]);
            $result = $handler->fetchAll();
            if(!empty($result)){
                foreach($result as $role){
                    $roles[] = $role['role'];
                }
            }
        }
    }
}