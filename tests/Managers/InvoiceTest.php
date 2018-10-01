<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\InvoiceFaker;
use Railken\Amethyst\Managers\InvoiceManager;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class InvoiceTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = InvoiceManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = InvoiceFaker::class;
}
