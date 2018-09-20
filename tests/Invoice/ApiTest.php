<?php

namespace Railken\LaraOre\Tests\Invoice;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Api\Support\Testing\TestableBaseTrait;
use Railken\LaraOre\Invoice\InvoiceFaker;
use Railken\LaraOre\InvoiceItem\InvoiceItemFaker;
use Railken\LaraOre\InvoiceItem\InvoiceItemManager;

class ApiTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = InvoiceFaker::class;

    /**
     * Router group resource.
     *
     * @var string
     */
    protected $group = 'admin';

    /**
     * Base path config.
     *
     * @var string
     */
    protected $config = 'ore.invoice';

    public function testInvoiceIssued()
    {
        $response = $this->callAndTest('post', $this->getResourceUrl(), InvoiceFaker::make()->parameters()->toArray(), 201);

        $resource = json_decode($response->getContent())->data;

        $am = new InvoiceItemManager();

        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));
        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));

        $this->callAndTest('post', $this->getResourceUrl().'/'.$resource->id.'/issue', [], 200);
    }
}
