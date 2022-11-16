<?php

namespace App\Helpers;

use App\Core\Application;
use DI\Container;

class App
{
    /**
     * @return \App\Core\Application
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public static function get(): Application
    {
        $container = new Container();
        return $container->get(Application::class);
    }
}