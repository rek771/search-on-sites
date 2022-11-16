<?php

namespace App\Core;

use App\Exceptions\HttpNotFound;
use App\Helpers\Str;

class Router
{
    /**
     * @var \App\Core\Application
     */
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Запускает роутинг
     * @throws \App\Exceptions\HttpNotFound
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    function start()
    {
        $controllerName = "\\App\\Controllers\\{$this->getControllerName()}";
        $actionName = $this->getActionName();

        if (class_exists($controllerName)) {
            $controller = $this->app->provider()->get($controllerName);
        } else {
            throw new HttpNotFound("Controler {$controllerName} not found");
        }

        $action = $actionName;

        if (method_exists($controller, $action)) {
            $response = $controller->$action();

            if (!empty($response)){
                $response->send();
            }
        } else {
            throw new HttpNotFound("Controler {$controllerName}@{$actionName} not found");
        }

    }

    /**
     * @return string Возвращает имя контроллера, которое берется из строки адреса запроса
     */
    public function getControllerName()
    {
        if ($_SERVER['REQUEST_URI'] == '/') {
            $name = 'Index';
        }else {

            $name = explode('/', $_SERVER['REQUEST_URI'])[1];
        }
        return ucfirst("{$name}Controller");
    }

    /**
     * @return string Возвращает имя обрабатывающего метода. Имя метода совпадает с HTTP методом запроса
     */
    public function getActionName(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}