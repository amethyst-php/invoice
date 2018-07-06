<?php

namespace Railken\LaraOre\Invoice;

use Railken\Bag;
use Faker\Factory;
use Railken\LaraOre\Tax\TaxFaker;
use Railken\LaraOre\LegalEntity\LegalEntityFaker;
use Railken\LaraOre\Taxonomy\TaxonomyFaker;
use Illuminate\Support\Facades\Config;

class InvoiceFaker
{
    /**
     * @return \Railken\Bag
     */
    public static function make()
    {
        $faker = Factory::create();
        
        $bag = new Bag;

        $bag->set('number', '2/2018');
        $bag->set('country', 'IT');
        $bag->set('locale', 'it_IT');
        $bag->set('currency', 'EUR');
        $bag->set('tax', TaxFaker::make()->toArray());
        $bag->set('recipient', LegalEntityFaker::make()->toArray());
        $bag->set('type', TaxonomyFaker::make()->toArray());
        $bag->set('type.vocabulary.name', Config::get('ore.invoice.taxonomy'));
        $bag->set('sender', LegalEntityFaker::make()->toArray());
        $bag->set('issued_at', '2018-01-01 00:00:00');
        $bag->set('expires_at', '2019-01-01 00:00:00');
        
        return $bag;
    }
}
