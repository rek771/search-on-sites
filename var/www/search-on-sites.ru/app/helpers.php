<?php

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param  mixed   $default
     * @return mixed
     */
    function env(string $key, $default = null)
    {
        $container = new Container();

        try {
            return $container->get('env')->get($key, $default);
        } catch (DependencyException | NotFoundException $e) {
            return $default;
        }
    }
}