<?php

namespace Railken\Amethyst\Tests\Http\Admin;

use Railken\Amethyst\Api\Support\Testing\TestableBaseTrait;
use Railken\Amethyst\Fakers\InvoiceFaker;
use Railken\Amethyst\Fakers\InvoiceItemFaker;
use Railken\Amethyst\Managers\InvoiceItemManager;
use Railken\Amethyst\Tests\BaseTest;

class InvoiceTest extends BaseTest
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
     * Route name.
     *
     * @var string
     */
    protected $route = 'admin.invoice';

    public function testInvoiceIssued()
    {
        $response = $this->callAndTest('POST', route('admin.invoice.create'), InvoiceFaker::make()->parameters()->toArray(), 201);

        $resource = json_decode($response->getContent())->data;

        $am = new InvoiceItemManager();

        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));
        $am->create(InvoiceItemFaker::make()->parameters()->remove('invoice')->set('invoice_id', $resource->id));
        $this->callAndTest('POST', route('admin.invoice.issue', ['id' => $resource->id]), [], 200);
    }
}
