<?php

namespace Webkul\SizeChart\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\SizeChart\Models\SizeChart::class,
        \Webkul\SizeChart\Models\AssignTemplate::class
    ];

    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Http/admin-routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'sizechart');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'sizechart');
        
        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('vendor/webkul/size-chart/assets'),
            __DIR__ . '/../Resources/views/shop' => resource_path('themes/velocity/views/shop'),
        ]);
    }
}