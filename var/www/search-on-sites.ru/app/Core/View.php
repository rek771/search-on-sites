<?php

namespace App\Core;

class View
{
    function generate($templateView)
    {
        include __DIR__.'/../../resources/views/'.$templateView.'.php';
    }
}