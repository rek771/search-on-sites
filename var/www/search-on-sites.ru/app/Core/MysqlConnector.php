<?php

namespace App\Core;

use App\Contracts\DbConnector;

class MysqlConnector extends DbConnector
{
    /**
     * @var \App\Core\Application
     */
    private Application $app;

    /**
     * @param \App\Core\Application $app
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        parent::__construct(
            'mysql:host=' . $this->app->env('MYSQL_HOST') . ';port='.$this->app->env('MYSQL_PORT').';dbname=' . $this->app->env('MYSQL_DATABASE'),
            $this->app->env('MYSQL_USERNAME'),
            $this->app->env('MYSQL_PASSWORD')
        );
    }
}