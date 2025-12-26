@if (isset($hideShippingMethod) && $hideShippingMethod)
    @php
        // Remove shipping method section
        $content = view('shop::checkout.onepage.index')->render();
        $content = preg_replace('/<x-shop::checkout\.onepage\.shipping-method\s*\/>/', '', $content);
        echo $content;
    @endphp
@else
    @include('shop::checkout.onepage.index')
@endif
