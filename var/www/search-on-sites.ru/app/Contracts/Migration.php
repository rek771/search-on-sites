<?php

namespace App\Contracts;

interface Migration
{
    public function up(): void;

    public function down(): void;
}