<?php

namespace App\Core;

use App\Contracts\Handler;
use App\Core\ConsoleKernel;
use App\Core\Environment;
use App\Core\HttpKernel;
use DI\Container;

class Application
{
    /** @var string|null  */
    private ?string $basePath;

    /** @var \DI\Container  */
    private Container $container;

    /** @var \App\Core\Environment  */
    private Environment $environment;

    /** @var \App\Contracts\Handler */
    private Handler $handler;

    /**
     * Create a new Lumen application instance.
     *
     * @param string|null $basePath
     * @return void
     */
    public function __construct(string $basePath = null)
    {
        $this->container = new Container();
        $this->basePath = $basePath;

        $this->environment = new Environment($this->basePath);

        $this->container->set('env', $this->environment);
        $this->container->set(self::class, $this);
        $this->container->set('app', $this);
    }

    public function run()
    {
        if ($this->isRunningInConsole()){
            $this->handler = new ConsoleKernel();
        }else{
            $this->handler = new HttpKernel($this);
        }

        $this->handler->handle($this);
    }


    /**
     * Determine if the application is running in the console.
     *
     * @return bool
     */
    public function isRunningInConsole(): bool
    {
        return php_sapi_name() === 'cli' || php_sapi_name() === 'phpdbg';
    }
}