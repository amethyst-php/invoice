<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\InvoiceContainerFaker;
use Railken\Amethyst\Managers\InvoiceContainerManager;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class InvoiceContainerTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = InvoiceContainerManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = InvoiceContainerFaker::class;
}
