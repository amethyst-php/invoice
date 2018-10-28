<?php

namespace Railken\Amethyst\Fakers;

use Faker\Factory;
use Illuminate\Support\Facades\Config;
use Railken\Bag;
use Railken\Lem\Faker;

class InvoiceItemFaker extends Faker
{
    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', 'something');
        $bag->set('unit', TaxonomyFaker::make()->parameters()->set('unit.name', 'pz')->toArray());
        $bag->set('unit.parent.name', Config::get('amethyst.invoice.data.invoice-item.unit_taxonomy'));
        $bag->set('description', 'maybe');
        $bag->set('quantity', 10);
        $bag->set('price', 19.99);
        $bag->set('tax', TaxFaker::make()->parameters()->toArray());
        $bag->set('invoice', InvoiceFaker::make()->parameters()->toArray());
        $bag->set('invoice_container', InvoiceContainerFaker::make()->parameters()->toArray());

        return $bag;
    }
}
