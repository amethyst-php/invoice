<?php

namespace Railken\LaraOre\InvoiceTax;

use Illuminate\Support\ServiceProvider;

class InvoiceTaxServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        InvoiceTax::observe(InvoiceTaxObserver::class);
    }
}
