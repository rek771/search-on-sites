<?php

namespace App\Core;

use App\Exceptions\HttpNotFound;
use App\Helpers\Str;

class Router
{
    /**
     * @throws \App\Exceptions\HttpNotFound
     */
    function start()
    {
        $controllerName = "\\App\\Controllers\\{$this->getControllerName()}";
        $actionName = $this->getActionName();

        if (class_exists($controllerName)) {
            $controller = new $controllerName;
        } else {
            throw new HttpNotFound("Controler {$controllerName} not found");
        }

        $action = $actionName;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            throw new HttpNotFound("Controler {$controllerName}@{$actionName} not found");
        }

    }

    public function getControllerName()
    {
        if ($_SERVER['REQUEST_URI'] == '/') {
            $name = 'Index';
        }else {

            $name = explode('/', $_SERVER['REQUEST_URI']);
        }

        return ucfirst("{$name}Controller");
    }

    public function getActionName(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    static function errorPage404()
    {
        $host = 'https://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

    function redirect($to)
    {
        $host = 'https://' . $_SERVER['HTTP_HOST'] . '/' . $to;
        header('HTTP/1.1 302 Found');
        header("Status: 302 Found");
        header('Location:' . $host);
    }
}