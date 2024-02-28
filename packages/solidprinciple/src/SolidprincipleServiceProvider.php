<?php
namespace Devil\Solidprinciple;


use Devil\Solidprinciple\app\console\Commands\solid;
use Illuminate\Support\ServiceProvider;

class SolidprincipleServiceProvider extends ServiceProvider
{


    public function register()
    {

    }
    public function boot(): void
    {
           $this->loadRoutesFrom(__DIR__.'/routes/web.php');
//        if ($this->app->running6InConsole()) {
            $this->commands([
                solid::class,
            ]);
//        }
    }

}
