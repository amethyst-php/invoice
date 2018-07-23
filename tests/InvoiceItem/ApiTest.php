<?php

namespace Railken\LaraOre\Tests\InvoiceItem;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\InvoiceItem\InvoiceItemFaker;
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
        return Config::get('ore.api.router.prefix').Config::get('ore.invoice-item.http.admin.router.prefix');
    }

    /**
     * Test common requests.
     */
    public function testSuccessCommon()
    {
        $this->commonTest($this->getBaseUrl(), InvoiceItemFaker::make()->parameters());
    }
}
