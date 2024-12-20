<?php 

namespace Geekbrains\Application1\Application;

use Exception;
use Geekbrains\Application1\Infrastructure\Config;
use Geekbrains\Application1\Infrastructure\Storage;

class Application {
    private const APP_NAMESPACE = "Geekbrains\Application1\Domain\Controllers\\";
    private string $controllerName;
    private string $methodName;

    public static Config $config;

    public static Storage $storage;

    function __construct() {
        Application::$config = new Config();
        Application::$storage = new Storage();
    }
        
    function run() {
        $routeArray = explode('/', $_SERVER['REQUEST_URI']);
        if(isset($routeArray[1]) && $routeArray[1] != '') {
            $controllerName = $routeArray[1];
        }
        else{
            $controllerName = "page";
        }
        $this->controllerName = Application::APP_NAMESPACE . ucfirst($controllerName) . "Controller";
        if(class_exists($this->controllerName)){
            if(isset($routeArray[2]) && $routeArray[2] != '') {
                $methodName = $routeArray[2];
            }
            else {
                $methodName = "index";
            }
        $this->methodName = "action" . ucfirst($methodName);
        if(method_exists($this->controllerName, $this->methodName)){
            $controllerInstance = new $this->controllerName();
            $method = $this->methodName;
            return $controllerInstance->$method();
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
}