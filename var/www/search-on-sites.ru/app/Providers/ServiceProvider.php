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
use function DI\autowire;

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
        $this->container->set('app', autowire(Application::class));
        $this->container->set('env',  autowire(Environment::class));
        $this->container->set(DbConnector::class,  autowire(MysqlConnector::class));

        $this->container->set(Model::class, autowire(Model::class));
        $this->container->set(Downloader::class,  autowire(CurlDownloader::class));

        if ($this->app->isRunningInConsole()){
            $this->container->set(Handler::class, autowire(ConsoleKernel::class));
        }else{
            $this->container->set(View::class, autowire(View::class));
            $this->container->set(Router::class, autowire(Router::class));
            $this->container->set(Request::class, autowire(Request::class));

            $this->container->set(Response::class, autowire(Response::class));

            $this->container->set(Controller::class, autowire(Controller::class));

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