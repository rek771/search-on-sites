<?php

namespace App\Core;

use App\Contracts\Handler;
use App\Providers\ServiceProvider;

class Application
{
    /** @var string|null */
    private ?string $basePath;

    /** @var ServiceProvider */
    private ServiceProvider $provider;

    /**
     * Создает новый инстанс приложения
     *
     * @param string|null $basePath
     * @return void
     */
    public function __construct(string $basePath = null)
    {
        $this->basePath = $basePath;

        $this->provider = new ServiceProvider($this);
    }

    /**
     * Запускает работу приложения
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function run(): void
    {
        $this->provider->bind();

        if (!$this->env('DEBUG')) {
            ini_set('display_errors', 0);
        }

        /** @var Handler $handler */
        $handler = $this->provider->get(Handler::class);
        $handler->handle();
    }


    /**
     * Определяет запущено приложение из консоли или нет
     *
     * @return bool
     */
    public function isRunningInConsole(): bool
    {
        return php_sapi_name() === 'cli' || php_sapi_name() === 'phpdbg';
    }

    /**
     * Возвращает путь до корня приложения
     * @return string|null
     */
    public function path(): ?string
    {
        return $this->basePath;
    }

    /**
     * @return \App\Providers\ServiceProvider
     */
    public function provider(): ServiceProvider
    {
        return $this->provider;
    }

    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     *
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function env(string $key, $default = null)
    {
        return $this->provider()->get(Environment::class)->get($key, $default);
    }
}