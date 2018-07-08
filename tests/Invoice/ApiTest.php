<?php

namespace Railken\LaraOre\Tests\Invoice;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Support\Testing\ApiTestableTrait;
use Railken\LaraOre\Invoice\InvoiceFaker;
use Railken\LaraOre\InvoiceItem\InvoiceItemFaker;
use Railken\LaraOre\InvoiceItem\InvoiceItemManager;

class ApiTest extends BaseTest
{
    use ApiTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return Config::get('ore.api.router.prefix').Config::get('ore.invoice.router.prefix');
    }

    /**
     * Test common requests.
     *
     * @return void
     */
    public function testSuccessCommon()
    {
        $this->commonTest($this->getBaseUrl(), InvoiceFaker::make()->parameters());
    }

    public function testInvoiceIssued()
    {
        $response = $this->post($this->getBaseUrl(), InvoiceFaker::make()->parameters()->toArray());
        $this->assertOrPrint($response, 201);

        $resource = json_decode($response->getContent())->resource;

        $am = new InvoiceItemManager();

        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));
        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));

        $response = $this->post($this->getBaseUrl().'/'.$resource->id.'/issue', []);
        $this->assertOrPrint($response, 200);
    }
}
