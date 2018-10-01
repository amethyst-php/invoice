<?php

namespace Railken\Amethyst\Tests\Listeners;

use Railken\Amethyst\Fakers\InvoiceFaker;
use Railken\Amethyst\Fakers\InvoiceItemFaker;
use Railken\Amethyst\Managers\InvoiceItemManager;
use Railken\Amethyst\Managers\InvoiceManager;
use Railken\Amethyst\Tests\BaseTest;

class InvoiceTest extends BaseTest
{
    public function testInvoiceIssued()
    {
        $manager = new InvoiceManager();

        $result = $manager->create(InvoiceFaker::make()->parameters()->toArray());
        $this->assertEquals(true, $result->ok());

        $resource = $result->getResource();

        $am = new InvoiceItemManager();

        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));
        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));
        $manager->issue($result->getResource());
    }
}
