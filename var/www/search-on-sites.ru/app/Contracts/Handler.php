<?php

namespace App\Contracts;

interface Handler
{
    /**
     * Запускает выполнение чего либо
     * @return mixed
     */
    public function handle();
}