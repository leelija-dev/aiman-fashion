<?php

namespace Webkul\Custom\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register module provider
        $this->app->register(ModuleServiceProvider::class);

        // Register view related provider
        $this->app->register(CheckoutViewServiceProvider::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'custom');
    }
}
