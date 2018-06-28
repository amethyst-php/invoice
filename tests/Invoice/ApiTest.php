<?php

namespace Railken\LaraOre\Tests\Invoice;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Support\Testing\ApiTestableTrait;

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
        $this->commonTest($this->getBaseUrl(), $parameters = $this->getParameters());
    }

    public function testInvoiceIssued()
    {
        $response = $this->post($this->getBaseUrl(), $this->getParameters()->toArray());
        $this->assertOrPrint($response, 201);

        $resource = json_decode($response->getContent())->resource;
        $this->newInvoiceItem($resource->id);
        $this->newInvoiceItem($resource->id);

        $response = $this->post($this->getBaseUrl().'/'.$resource->id.'/issue', []);
        $this->assertOrPrint($response, 200);
    }
}
