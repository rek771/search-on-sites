<?php

namespace App\Core;


use Dotenv\Dotenv;

class Environment
{
    /**
     * @var \App\Core\Application
     */
    private Application $app;
    private array $env;

    public function __construct(Application $app)
    {
        $this->app = $app->provider()->get(Application::class);
        $dotenv = Dotenv::createImmutable(__DIR__.'/../..');
        $dotenv->load();
    }

    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}