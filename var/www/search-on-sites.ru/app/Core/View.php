<?php

namespace App\Core;


class View
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
     * Генерирует View представление внутри шаблона layout
     * @param $template
     * @param array $variables
     */
    public function renderWithLayout($template, $variables = []){
        $variables['nextTemplate'] = $template;
        $variables['nextVariables'] = $variables;
        $variables['nextVariables']['appPath'] = $this->app->path();
        $this->render('layout', $variables);
    }

    /**
     * Генерирует View представление
     * @param string $template
     * @param array $variables
     */
    public function render(string $template, $variables = []): void
    {
        if (isset($variables['appPath'])){
            $appPath = $variables['appPath'];
        }else{
            $appPath = $this->app->path();
        }

        $template = str_replace('.', '/', $template);
        extract($variables);
        ob_start();
        include $appPath . '/resources/views/' . $template . '.php';
        $html = ob_get_contents();
        ob_end_clean();
        echo $html;
    }

}