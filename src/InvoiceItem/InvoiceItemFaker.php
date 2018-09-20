<?php

namespace Railken\LaraOre\InvoiceItem;

use Faker\Factory;
use Illuminate\Support\Facades\Config;
use Railken\Bag;
use Railken\LaraOre\Invoice\InvoiceFaker;
use Railken\LaraOre\Tax\TaxFaker;
use Railken\LaraOre\Taxonomy\TaxonomyFaker;
use Railken\Laravel\Manager\BaseFaker;

class InvoiceItemFaker extends BaseFaker
{
    /**
     * @var string
     */
    protected $manager = InvoiceItemManager::class;

    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();

        $bag->set('name', 'something');
        $bag->set('unit', TaxonomyFaker::make()->parameters()->set('unit.name', 'pz')->toArray());
        $bag->set('unit.vocabulary.name', Config::get('ore.invoice-item.unit_taxonomy'));
        $bag->set('description', 'maybe');
        $bag->set('quantity', 10);
        $bag->set('price', 19.99);
        $bag->set('tax', TaxFaker::make()->parameters()->toArray());
        $bag->set('invoice', InvoiceFaker::make()->parameters()->toArray());

        return $bag;
    }
}
