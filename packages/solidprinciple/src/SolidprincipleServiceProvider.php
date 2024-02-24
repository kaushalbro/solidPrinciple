<?php
namespace Devil\Solidprinciple;


use Illuminate\Support\ServiceProvider;

class SolidprincipleServiceProvider extends ServiceProvider
{


    public function register()
    {

    }
    public function boot(): void
    {
           include(__DIR__.'/routes/web.php');
    }

}
