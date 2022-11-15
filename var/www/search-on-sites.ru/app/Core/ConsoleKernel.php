<?php

namespace App\Core;

use App\Contracts\Handler;
use App\Exceptions\CommandNotFound;
use App\Helpers\Str;

class ConsoleKernel implements Handler
{

    const HELP_TEXT = "
    Для работы необходимо ввести название команды через флаг -c или --command .
    
    Пример: 
    php runner -c parser 
    ";

    /**
     * @throws \App\Exceptions\CommandNotFound
     */
    public function handle()
    {
        $shortopts = 'c:';

        $longopts = [
            "command:"
        ];

        echo php_sapi_name() . PHP_EOL;
        $options = getopt($shortopts, $longopts);
        $command = $options['c'] ?? ($options['command'] ?? '');

        if (empty($command)) {
            echo self::HELP_TEXT;
        } else {

            $controllerClass = '\\App\\Commands\\' . Str::camel($command);
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass;
                $controller->run();
            } else {
                throw new CommandNotFound('Command "' . $command . '" not exists.');
            }
        }

        return 0; // exit code
    }
}
