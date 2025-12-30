

@php
    $sizeChartController = app(
        \Webkul\SizeChart\Http\Controllers\Shop\SizeChartController::class
    );

    $productId = $product->id;
    $template  = $sizeChartController->getSizeChart($productId);
@endphp

@if (core()->getConfigData('catalog.products.size-chart.enable-sizechart') && $template)

    <a href="javascript:void(0)"
       class="text-sm text-blue-600 cursor-pointer"
       onclick="window.app.showModal('downloadDataGrid')">
        {{ __('sizechart::app.sizechart.template.view-size-chart') }}
    </a>

@endif
