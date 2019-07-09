<?php

namespace Amethyst\Tests\Managers;

use Amethyst\Fakers\InvoiceContainerFaker;
use Amethyst\Managers\InvoiceContainerManager;
use Amethyst\Tests\BaseTest;
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
