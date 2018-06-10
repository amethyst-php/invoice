<?php

namespace Railken\LaraOre\Tests\Invoice;

use Railken\LaraOre\Invoice\InvoiceManager;
use Railken\LaraOre\Support\Testing\ManagerTestableTrait;

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
        $this->commonTest(new InvoiceManager(), $this->getParameters());
    }
}
