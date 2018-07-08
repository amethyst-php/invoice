<?php

namespace Railken\LaraOre\Tests\Invoice;

use Railken\LaraOre\Invoice\InvoiceManager;
use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\Invoice\InvoiceFaker;
use Railken\LaraOre\InvoiceItem\InvoiceItemFaker;
use Railken\LaraOre\InvoiceItem\InvoiceItemManager;

class ManagerTest extends BaseTest
{
    use ManagerTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new InvoiceManager();
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), InvoiceFaker::make()->parameters());
    }

    public function testInvoiceIssued()
    {
        $result = $this->getManager()->create(InvoiceFaker::make()->parameters()->toArray());
        $this->assertEquals(true, $result->ok());

        $resource = $result->getResource();

        $am = new InvoiceItemManager();

        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));
        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));
        $this->getManager()->issue($result->getResource());
    }
}
