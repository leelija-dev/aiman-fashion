<?php

namespace Webkul\Custom\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CheckoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load views from our custom directory
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'custom');
        
        // Prepend our views to the shop namespace
        View::prependNamespace('shop', __DIR__.'/../Resources/views/shop');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}