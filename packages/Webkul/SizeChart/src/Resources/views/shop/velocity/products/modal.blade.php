@php
    $sizeChartController = app(
        \Webkul\SizeChart\Http\Controllers\Shop\SizeChartController::class
    );

    $productId = $product->product_id ?: $product->id;
    $template  = $sizeChartController->getSizeChart($productId);

    $options = $template
        ? $sizeChartController->getOptions($template->id)
        : [];
       
@endphp

@if ($template)

    {{-- Trigger --}}
    <a href="javascript:void(0)"
       class="text-sm text-blue-600 cursor-pointer"
       onclick="window.app.showModal('downloadDataGrid')">
        View Size Chart
    </a>

    {{-- Modal --}}
    <x-shop::modal
        id="downloadDataGrid"
        :is-large="true"
        :title="$template->template_name ?? 'Size Chart'">

        SIZE CHART CONTENT HERE

    </x-shop::modal>

@endif
