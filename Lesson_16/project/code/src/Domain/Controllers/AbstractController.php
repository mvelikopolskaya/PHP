<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Application;

class AbstractController {

    protected array $actionsPermissions = [];
    protected array $alwaysEnabledMethods = [];
    
    public function getUserRoles(): array {
        $roles = [];
        $roles[] = 'user';
        if(isset($_SESSION['id_user'])){
            $result = $this->getRolesFromDB();
            if(!empty($result)){
                foreach($result as $role){
                    $roles[] = $role['role'];
                }
            }
        }
        return $roles;
    }

    private function getRolesFromDB() : array {
        $rolesSql = "SELECT user_role FROM users WHERE id_user = :id";
        $handler = Application::$storage->get()->prepare($rolesSql);
        $handler->execute(['id' => $_SESSION['id_user']]);
        return $handler->fetchAll();
    }

    public function getActionsPermissions(string $methodName): array {
        return isset($this->actionsPermissions[$methodName]) ? $this->actionsPermissions[$methodName] : [];
    }
}