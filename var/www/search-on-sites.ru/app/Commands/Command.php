<?php
namespace App\Commands;

use App\Core\Application;

abstract class Command
{
    /**
     * @var \App\Core\Application
     */
    protected Application $app;

    public function __construct(Application $app)
   {
       $this->app = $app;
   }
}