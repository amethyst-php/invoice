<?php

namespace Railken\LaraOre\Tests\Invoice;

use Illuminate\Support\Facades\File;
use Railken\Bag;
use Railken\LaraOre\Address\AddressManager;
use Railken\LaraOre\Invoice\InvoiceManager;
use Railken\LaraOre\InvoiceItem\InvoiceItemManager;
use Railken\LaraOre\LegalEntity\LegalEntityManager;
use Railken\LaraOre\Tax\TaxManager;
use Railken\LaraOre\Taxonomy\TaxonomyManager;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\LaraOre\InvoiceServiceProvider::class,
        ];
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
        $this->withHeaders(['Accept' => 'application/json']);

        $this->artisan('migrate:fresh');
        $this->artisan('lara-ore:invoice:install');

        $this->artisan('vendor:publish', [
            '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
            '--force'    => true,
        ]);

        $this->artisan('vendor:publish', [
            '--provider' => 'Railken\LaraOre\InvoiceServiceProvider',
            '--force'    => 'true',
        ]);

        $this->artisan('migrate');
    }
}
