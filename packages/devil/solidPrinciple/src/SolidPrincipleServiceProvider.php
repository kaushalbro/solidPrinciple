<?php
namespace  Devil\SolidPrinciple;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SolidPrincipleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::get('/route', function () {
            dd('fdfd');
            return 'fdfdf';
        });

    }
}
