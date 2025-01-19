<?php
namespace Devil\Solidprinciple;
use Devil\Solidprinciple\app\console\Commands\solid;
use Devil\Solidprinciple\app\Services\SideBar;
use Illuminate\Support\ServiceProvider;
class SolidPrincipleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (file_exists(app_path("Providers/SolidAppServiceProvider.php")))
               $this->app->register(\App\Providers\SolidAppServiceProvider::class);
        $this->app->singleton('sidebar', function () {
            try {
              return SideBar::getSidebarMetadata();
            }catch (\Exception $exception){
                return ['error' => $exception->getMessage()];
            }
        });
    }
    public function boot(): void
    {
      $this->loadRoutesFrom(__DIR__.'/routes/web.php');
      $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
      $this->publishes([__DIR__ . '/routes/route.php' =>base_path('routes/solid.php')], 'solidRoutes');
      $this->publishes([__DIR__ . '/provider/app.php' => base_path('app/Providers/SolidAppServiceProvider.php')], 'solidAppServiceProvider');
      $this->commands([solid::class]);
    }

}
