<?php

namespace Webkul\Custom\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Webkul\Custom\View\Composers\CheckoutComposer;

class CheckoutViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register view composer
        View::composer('shop::checkout.onepage.index', CheckoutComposer::class);
    }
}
