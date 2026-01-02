<?php

namespace Webkul\CustomCheckout\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CustomCheckoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Register view namespace for checkout
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'checkout');
        
        // Register shop namespace for overriding shop views with higher priority
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'shop');
        
        // Override specific views by extending the view factory
        $this->app->booted(function () {
            $view = $this->app['view'];
            $view->composer('shop::customers.account.addresses.create', function ($view) {
                $view->setPath(__DIR__ . '/../Resources/views/shop/customers/account/addresses/create.blade.php');
            });
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register any package services here
    }
}