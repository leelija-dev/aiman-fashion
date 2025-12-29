<?php

namespace Webkul\Custom\View\Composers;

use Illuminate\View\View;

class CheckoutComposer
{
    public function compose(View $view)
    {
        // Set flag to hide shipping method
        $view->with('hideShippingMethod', true);
        
        // Also set a global view variable that can be checked in the template
        view()->share('shouldHideShipping', true);
    }
}
