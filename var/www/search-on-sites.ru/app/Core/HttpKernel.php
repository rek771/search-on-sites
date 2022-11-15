<?php

namespace App\Core;


use App\Contracts\Handler;

class HttpKernel implements Handler
{
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->router = new Router();
    }

    public function handle(){

        $this->router->start();
    }

}
