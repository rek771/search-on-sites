<?php

namespace App\Core;

class Request
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
     * Возвращает параметр из тела запроса пользователя
     * @param $param
     * @return mixed|null
     */
    public function get($param)
    {
        return $_REQUEST[$param] ?? null;
    }
}