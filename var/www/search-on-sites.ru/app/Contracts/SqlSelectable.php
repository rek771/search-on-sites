<?php

namespace App\Contracts;

interface SqlSelectable
{
    public function select(string $sql): array;
}