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

    public function testNotUnique()
    {
        $resource = $this->getManager()->create($this->getParameters())->getResource();

        $this->assertEquals(false, $this->getManager()->create($this->getParameters()->set('sender_id', $resource->sender->id))->ok());
    }

    public function testInvoiceIssued()
    {
        $result = $this->getManager()->create($this->getParameters());
        $this->assertEquals(true, $result->ok());
        $this->newInvoiceItem($result->getResource());
        $this->newInvoiceItem($result->getResource());
        $this->newListener();
        $this->getManager()->issue($result->getResource());
    }
}
