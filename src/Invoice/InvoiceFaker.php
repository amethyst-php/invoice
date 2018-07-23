<?php

namespace Railken\LaraOre\Invoice;

use Faker\Factory;
use Illuminate\Support\Facades\Config;
use Railken\Bag;
use Railken\LaraOre\LegalEntity\LegalEntityFaker;
use Railken\LaraOre\Tax\TaxFaker;
use Railken\LaraOre\Taxonomy\TaxonomyFaker;
use Railken\Laravel\Manager\BaseFaker;

class InvoiceFaker extends BaseFaker
{
    /**
     * @var string
     */
    protected $manager = InvoiceManager::class;

    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();

        $bag->set('number', '2/2018');
        $bag->set('country', 'IT');
        $bag->set('locale', 'it_IT');
        $bag->set('currency', 'EUR');
        $bag->set('tax', TaxFaker::make()->parameters()->toArray());
        $bag->set('recipient', LegalEntityFaker::make()->parameters()->toArray());
        $bag->set('type', TaxonomyFaker::make()->parameters()->toArray());
        $bag->set('type.vocabulary.name', Config::get('ore.invoice.taxonomy'));
        $bag->set('sender', LegalEntityFaker::make()->parameters()->toArray());
        $bag->set('issued_at', '2018-01-01 00:00:00');
        $bag->set('expires_at', '2019-01-01 00:00:00');

        return $bag;
    }
}
