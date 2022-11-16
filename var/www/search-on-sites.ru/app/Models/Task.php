<?php
namespace App\Models;

class Task extends Model
{
    const TYPE_IMG = 1;
    const TYPE_HREF = 2;
    const TYPE_TEXT = 3;

    protected string $table = 'tasks';
}