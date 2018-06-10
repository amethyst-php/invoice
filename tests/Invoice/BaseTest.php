<?php

namespace Railken\LaraOre\Tests\Invoice;

use Illuminate\Support\Facades\File;
use Railken\Bag;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\LaraOre\InvoiceServiceProvider::class,
        ];
    }

    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function getParameters()
    {
        $bag = new bag();
        $bag->set('name', 'a common name');
        return $bag;
    }

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/../..', '.env');
        $dotenv->load();

        parent::setUp();

        File::cleanDirectory(database_path('migrations/'));

        $this->artisan('migrate:fresh');
        $this->artisan('lara-ore:user:install');

        $this->artisan('vendor:publish', [
            '--provider' => 'Railken\LaraOre\InvoiceServiceProvider',
            '--force'    => 'true',
        ]);

        $this->artisan('migrate');
    }
}
