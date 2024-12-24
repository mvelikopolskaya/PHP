<?php 

namespace Geekbrains\Application1\Application;

use Exception;
use Geekbrains\Application1\Application\Auth;
use Geekbrains\Application1\Infrastructure\Config;
use Geekbrains\Application1\Infrastructure\Storage;
use Geekbrains\Application1\Domain\Controllers\AbstractController;

class Application {
    private const APP_NAMESPACE = "Geekbrains\Application1\Domain\Controllers\\";
    private string $controllerName;
    private string $methodName;

    public static Config $config;

    public static Storage $storage;
    public static Auth $auth;

    function __construct() {
        Application::$config = new Config();
        Application::$storage = new Storage();
        Application::$auth = new Auth();
    }

    public function run() : string {
        session_start();
        $this->controllerName = $this->setControllerName();
        if(class_exists($this->controllerName)){
            $this->methodName = $this->setMethodName();
            if(method_exists($this->controllerName, $this->methodName)){
                $controllerInstance = new $this->controllerName();
                if($controllerInstance instanceof AbstractController){
                    if($this->checkAccessToMethod($controllerInstance, $this->methodName)){
                        return call_user_func_array(
                        [$controllerInstance, $this->methodName],
                        []
                        );
                        }
                    else {
                        return "You don't have an access to the method";
                    }
                }
                else {
                    return call_user_func_array(
                        [$controllerInstance, $this->methodName],
                        []
                    );
                }
            }
            else {
                header("HTTP/1.1 404 Not Found");
                header("Location: /404.html");
                die();
            }
        }
        else {
            header("HTTP/1.1 404 Not Found");
            header("Location: /404.html");
            die();
        }
    }

    private function setControllerName() {
        $routeArray = explode('/', $_SERVER['REQUEST_URI']);
        if(isset($routeArray[1]) && $routeArray[1] != '') {
            $controllerName = $routeArray[1];
        }
        else{
            $controllerName = "page";
        }
        return Application::APP_NAMESPACE . ucfirst($controllerName) . "Controller";
    }
    
    private function setMethodName() {
        $routeArray = explode('/', $_SERVER['REQUEST_URI']);
        if(isset($routeArray[2]) && $routeArray[2] != '') {
             $methodName = $routeArray[2];
            }
            else {
                $methodName = "index";
            }
            return "action" . ucfirst($methodName);
        }

    private function checkAccessToMethod(AbstractController $controllerInstance, string $methodName): bool {
        $userRoles = $controllerInstance->getUserRoles();
        $rules = $controllerInstance->getActionsPermissions($methodName);
        $rules[] = 'user';
        $isAllowed = false;
        if(!empty($rules)){
            foreach($rules as $rolePermission){
                if(in_array($rolePermission, $userRoles)){
                    $isAllowed = true;
                    break;
                }
            }
        }
        return $isAllowed;
    }
}