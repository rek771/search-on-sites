<?php

namespace App\Core;

class Response
{
    const RESPONSE_TEMPLATES = [
        200 =>[
            "HTTP/1.1 200 OK",
            "Status: 200 OK",
            "Location: %s"
        ],
        400 =>[
            "HTTP/1.1 400 Bad Request",
            "Status: 400 Bad Request",
            "Location: %s/400"
        ],
        404 => [
            "HTTP/1.1 404 Not Found",
            "Status: 404 Not Found",
            "Location: %s/404"
        ],
        500 => [
            "HTTP/1.1 500 Internal Server Error",
            "Status: 500 Internal Server Error",
            "Location: %s/500"
        ]
    ];

    /** @var int  */
    private int $code;

    /** @var string|null  */
    private ?string $body;

    /** @var string|null  */
    private ?string $viewTemplates;

    /** @var \App\Core\View  */
    private View $view;
    /**
     * @var \App\Core\Application
     */
    private Application $app;
    /**
     * @var array
     */
    private array $templateVars;
    private $isLayouts;

    public function __construct(Application $app, View $view)
    {
        $this->view = $view;
        $this->code = 200;
        $this->body = null;
        $this->viewTemplates = null;
        $this->app = $app;
        $this->isLayouts = false;
    }

    /**
     * Записывает текст тела ответа
     * @param $body
     * @return $this
     */
    public function body($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Записывает имя шаблона VIEW для его возврата
     * @param $template
     * @param array $templateVars
     * @return $this
     */
    public function view($template, $templateVars = [])
    {
        $this->viewTemplates = $template;
        $this->templateVars = $templateVars;
        return $this;
    }

    /**
     * Записывает код ответа
     * @param $code
     * @return $this
     */
    public function code($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Отмечает, что перед выводом View необходимо применить стандартный шаблон (layout)
     * @return $this
     */
    public function withLayouts(){
        $this->isLayouts = true;
        return $this;
    }

    /**
     * Отправляет ответ пользователю
     */
    public function send()
    {
        if (isset(self::RESPONSE_TEMPLATES[$this->code])) {
            $host =  $_SERVER['HTTP_HOST'];
            header(self::RESPONSE_TEMPLATES[$this->code][0]);
            header(self::RESPONSE_TEMPLATES[$this->code][1]);
            header(sprintf(self::RESPONSE_TEMPLATES[$this->code][2], $host));

            if ($this->code !== 200) {
                $this->view->render("errors.$this->code");
                echo "\n";
            }
        }

        if (isset($this->body)) {
            echo $this->body;
            echo "\n";
        }

        if (isset($this->viewTemplates)) {
            if ($this->isLayouts){
                $this->view->renderWithLayout($this->viewTemplates, $this->templateVars);
            }else {
                $this->view->render($this->viewTemplates, $this->templateVars);
            }
        }
    }
}