<?php

namespace App\Providers;

use App\Contracts\Handler;
use App\Core\Application;
use App\Core\ConsoleKernel;
use App\Core\Environment;
use App\Core\HttpKernel;
use App\Core\Request;
use App\Core\Responce;
use App\Core\Router;
use DI\Container;

class ServiceProvider
{
    private Application $app;
    /**
     * @var \DI\Container
     */
    private Container $container;

    public function __construct(Application $app)
    {
        $this->container = new Container();
        $this->app = $app;
    }

    /**
     * Устанавливает необходимые зависимости
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function bind()
    {

        $this->container->set('env',  new Environment($this->app->path()));
        $this->container->set(Application::class, $this->app);
        $this->container->set('app', $this->app);


        if ($this->app->isRunningInConsole()){
            $this->container->set(Handler::class, new ConsoleKernel());
        }else{
            $this->container->set(Router::class, new Router());
            $this->container->set(Request::class, new Request());
            $this->container->set(Responce::class, new Responce());

            $this->container->set(
                Handler::class,
                new HttpKernel(
                    $this->container->get('app'),
                    $this->container->get(Router::class),
                    $this->container->get(Request::class),
                    $this->container->get(Responce::class),
                )
            );
        }

    }

    /**
     * Возвращает инстанс необходимых классов
     * @param string $name
     * @return mixed
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function get(string $name){
        return $this->container->get($name);
    }
}