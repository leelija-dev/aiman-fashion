<?php

namespace Webkul\Custom\Providers;

use Webkul\Core\Providers\CoreModuleServiceProvider;
use Webkul\Custom\Providers\CheckoutViewServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        // Your models (if any)
    ];

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        // Remove or comment out the next line if you don't have routes
        // $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'custom');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'custom');

        parent::boot();
    }

    public function register(): void
    {
        parent::register();

        $this->app->register(CheckoutViewServiceProvider::class);
        $this->app->register(CheckoutServiceProvider::class);
    }
}
