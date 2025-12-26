<?php

namespace Webkul\Custom\Providers;

use Illuminate\Support\ServiceProvider;
use Webkul\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        // Add your models here if any
    ];

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'custom');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'custom');
        
        parent::boot();
    }

    public function register()
    {
        parent::register();
        $this->app->register(CheckoutViewServiceProvider::class);
    }
}