<?php
namespace App\Controllers;

use App\Core\Application;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class Controller
{
    /**
     * @var \App\Core\View
     */
    protected View $view;

    /**
     * @var \App\Core\Response
     */
    protected Response $response;

    /**
     * @var \App\Core\Request
     */
    protected Request $request;
    /**
     * @var \App\Core\Application
     */
    protected Application $app;

    public function __construct(Application $app, View $view, Request $request, Response $response){
        $this->view = $view;
        $this->response = $response;
        $this->request = $request;
        $this->app = $app;

    }

    /**
     * Обработка GET запросов
     * @return \App\Core\Response
     */
    public function get(): Response
    {
        return $this->response->code(404);
    }

    /**
     * Обработка POST запросов
     * @return \App\Core\Response
     */
    public function post(): Response
    {
        return $this->response->code(404);
    }

    /**
     * Обработка PUT запросов
     * @return \App\Core\Response
     */
    public function put(): Response
    {
        return $this->response->code(404);
    }

    /**
     * Обработка DELETE запросов
     * @return \App\Core\Response
     */
    public function delete(): Response
    {
        return $this->response->code(404);
    }
}