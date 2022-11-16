<?php

namespace App\Contracts;

interface SqlExecutable
{
    public function execute(string $sql): void;
}