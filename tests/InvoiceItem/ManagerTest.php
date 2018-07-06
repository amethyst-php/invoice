<?php

namespace Railken\LaraOre\Tests\InvoiceItem;

use Railken\LaraOre\InvoiceItem\InvoiceItemManager;
use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\Laraore\InvoiceItem\InvoiceItemFaker;

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
        return new InvoiceItemManager();
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), InvoiceItemFaker::make()->toArray());
    }
}
