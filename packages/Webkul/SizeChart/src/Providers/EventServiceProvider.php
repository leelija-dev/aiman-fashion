<?php

namespace Webkul\SizeChart\Providers;

use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Attribute\Models\AttributeOption;
use Webkul\SizeChart\Models\SizeChart;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;


class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

      
        Event::listen('bagisto.shop.products.view.after', function ($viewRenderEventManager) {

            // Size chart trigger link
            $viewRenderEventManager->addTemplate(
                'sizechart::shop.velocity.products.sizechart'
            );

            // Size chart modal
            $viewRenderEventManager->addTemplate(
                'sizechart::shop.velocity.products.modal'
            );
        });


        Event::listen('bagisto.admin.catalog.product.edit.before', function () {

            $attribute = app(\Webkul\Attribute\Repositories\AttributeRepository::class)
                ->findOneByField('code', 'size_chart_id');

            if (! $attribute) {
                return;
            }

            // Important: prevent duplicate deletion during same request
            if ($attribute->options()->count()) {
                return;
            }

            \Webkul\SizeChart\Models\SizeChart::orderBy('template_name')
                ->get()
                ->each(function ($chart) use ($attribute) {

                    \Webkul\Attribute\Models\AttributeOption::create([
                        'attribute_id' => $attribute->id,
                        'admin_name'   => $chart->template_name,
                        'sort_order'   => 0,
                        'swatch_value' => $chart->template_code,
                    ]);
                });
        });
    }
}
