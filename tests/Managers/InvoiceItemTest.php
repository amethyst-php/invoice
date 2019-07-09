<?php

namespace Amethyst\Tests\Managers;

use Amethyst\Fakers\InvoiceItemFaker;
use Amethyst\Managers\InvoiceItemManager;
use Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class InvoiceItemTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = InvoiceItemManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = InvoiceItemFaker::class;
}
