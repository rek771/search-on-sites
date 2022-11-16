<?php

namespace App\Core;


use App\Contracts\Handler;
use App\Exceptions\HttpNotFound;

class HttpKernel implements Handler
{
    /** @var \App\Core\Application */
    private Application $app;

    /** @var \App\Core\Router */
    private Router $router;

    /** @var \App\Core\Request */
    private Request $request;

    /** @var \App\Core\Response */
    private Response $response;

    public function __construct(Application $app, Router $router, Request $request, Response $responce)
    {
        $this->app = $app;
        $this->router = $router;
        $this->request = $request;
        $this->response = $responce;
    }

    /**
     * Запускает обработку запроса пользователя
     */
    public function handle()
    {

        header('HTTP/1.1 500 Internal Server Error');
        try {
            $this->router->start();
        } catch (HttpNotFound $e) {
            $this->response->code(404)->body($e->getMessage())->send();
        } catch (\Exception $e) {
            $this->response->code(500)->body($e->getMessage())->send();
        }
    }

}
