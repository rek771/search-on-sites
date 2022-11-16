<?php

namespace App\Contracts;

interface Migration
{
    /**
     * Выкатывает миграцию
     */
    public function up(): void;

    /**
     * Откатывает миграцию
     */
    public function down(): void;
}