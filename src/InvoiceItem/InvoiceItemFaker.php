<?php

namespace Railken\LaraOre\InvoiceItem;

use Railken\Bag;
use Faker\Factory;
use Railken\LaraOre\Invoice\InvoiceFaker;
use Railken\LaraOre\Tax\TaxFaker;
use Railken\LaraOre\Taxonomy\TaxonomyFaker;
use Illuminate\Support\Facades\Config;

class InvoiceItemFaker
{
    /**
     * @return \Railken\Bag
     */
    public static function make()
    {
        $faker = Factory::create();
        
        $bag = new Bag();
        $bag->set('name', 'something');
        $bag->set('unit', TaxonomyFaker::make()->toArray());
        $bag->set('unit.vocabulary.name', Config::get('ore.invoice-item.unit_taxonomy'));
        $bag->set('description', 'maybe');
        $bag->set('quantity', 10);
        $bag->set('price', 19.99);
        $bag->set('tax', TaxFaker::make()->toArray());
        $bag->set('invoice', InvoiceFaker::make()->toArray());

        return $bag;
    }
}
