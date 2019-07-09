<?php

namespace Amethyst\Tests\Http\Admin;

use Amethyst\Api\Support\Testing\TestableBaseTrait;
use Amethyst\Fakers\InvoiceContainerFaker;
use Amethyst\Tests\BaseTest;

class InvoiceContainerTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = InvoiceContainerFaker::class;

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
    protected $route = 'admin.invoice-container';
}
