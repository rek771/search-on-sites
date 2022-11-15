<?php

namespace App\Core;

use Dotenv\Dotenv;

class Environment
{
    public function __construct($basePath)
    {
        $dotenv = Dotenv::createImmutable($basePath);
        $dotenv->load();
    }

    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}