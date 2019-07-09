<?php

namespace Amethyst\Tests\Listeners;

use Amethyst\Fakers\InvoiceFaker;
use Amethyst\Fakers\InvoiceItemFaker;
use Amethyst\Managers\InvoiceItemManager;
use Amethyst\Managers\InvoiceManager;
use Amethyst\Tests\BaseTest;

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
