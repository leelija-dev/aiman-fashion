<?php

namespace Webkul\SizeChart\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Webkul\SizeChart\Datagrids\TemplateDataGrid;


class SizeChartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Http/admin-routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'sizechart');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'sizechart');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // No need to register config here as it's handled by ModuleServiceProvider
        $this->app->singleton(TemplateDataGrid::class);
    }
}
