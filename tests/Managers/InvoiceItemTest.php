<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\InvoiceItemFaker;
use Railken\Amethyst\Managers\InvoiceItemManager;
use Railken\Amethyst\Tests\BaseTest;
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
