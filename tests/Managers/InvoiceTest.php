<?php

namespace Amethyst\Tests\Managers;

use Amethyst\Fakers\InvoiceFaker;
use Amethyst\Managers\InvoiceManager;
use Amethyst\Tests\BaseTest;
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
