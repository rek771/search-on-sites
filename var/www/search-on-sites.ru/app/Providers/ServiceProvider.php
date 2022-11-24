<?php

namespace App\Providers;

use App\Contracts\DbConnector;
use App\Contracts\Downloader;
use App\Contracts\Handler;
use App\Controllers\Controller;
use App\Core\Application;
use App\Core\ConsoleKernel;
use App\Core\Environment;
use App\Core\HttpKernel;
use App\Core\MysqlConnector;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Core\View;
use App\Models\Model;
use App\Services\CurlDownloader;
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
        $this->container->set(Application::class, $this->app);
        $this->container->set('app', $this->app);
        $this->container->set('env',  new Environment($this->container->get('app')));
        $this->container->set(DbConnector::class,  new MysqlConnector($this->container->get('app')));
        var_dump('preModel');
        $this->container->set(Model::class, new Model($this->container->get(DbConnector::class)));
        $this->container->set(Downloader::class,  new CurlDownloader());

        if ($this->app->isRunningInConsole()){
            $this->container->set(Handler::class, new ConsoleKernel($this->container->get('app')));
        }else{
            $this->container->set(View::class, new View($this->container->get('app')));
            $this->container->set(Router::class, new Router($this->container->get('app')));
            $this->container->set(Request::class, new Request($this->container->get('app')));

            $this->container->set(Response::class, new Response(
                $this->container->get('app'),
                $this->container->get(View::class)
            ));

            $this->container->set(Controller::class, new Controller(
                $this->container->get('app'),
                $this->container->get(View::class),
                $this->container->get(Request::class),
                $this->container->get(Response::class)
            ));

            $this->container->set(
                Handler::class,
                new HttpKernel(
                    $this->container->get('app'),
                    $this->container->get(Router::class),
                    $this->container->get(Request::class),
                    $this->container->get(Response::class),
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