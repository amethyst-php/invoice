<?php

namespace Railken\LaraOre\Tests\InvoiceItem;

use Illuminate\Support\Facades\File;
use Railken\Bag;
use Railken\LaraOre\Address\AddressManager;
use Railken\LaraOre\LegalEntity\LegalEntityManager;
use Railken\LaraOre\Taxonomy\TaxonomyManager;
use Railken\LaraOre\Invoice\InvoiceManager;
use Railken\LaraOre\InvoiceTax\InvoiceTaxManager;
use Railken\LaraOre\Listener\ListenerManager;
use Railken\LaraOre\Work\WorkManager;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\LaraOre\InvoiceServiceProvider::class,
        ];
    }

    /**
     * @return \Railken\LaraOre\Taxonomy\Taxonomy
     */
    public function newType()
    {
        $im = new InvoiceManager();

        $bag = new Bag();
        $bag->set('name', 'Ban');
        $bag->set('vocabulary_id', $im->getTaxonomyVocabulary()->id);

        $le = new TaxonomyManager();

        return $le->create($bag)->getResource();
    }

    /**
     * @return \Railken\LaraOre\LegalEntity\LegalEntity
     */
    public function newLegalEntity()
    {
        $bag = new Bag();
        $bag->set('name', str_random(40));
        $bag->set('notes', str_random(40));
        $bag->set('country_iso', 'IT');
        $bag->set('vat_number', '203458239B01');
        $bag->set('code_vat', '203458239B01');
        $bag->set('code_tin', '203458239B01');
        $bag->set('code_it_rea', '123');
        $bag->set('code_it_sia', '123');
        $bag->set('registered_office_address_id', $this->newAddress()->id);

        $lem = new LegalEntityManager();

        return $lem->create($bag)->getResource();
    }

    /**
     * @return \Railken\LaraOre\Address\Address
     */
    public function newAddress()
    {
        $am = new AddressManager();
        $bag = new Bag();
        $bag->set('name', 'El. psy. congroo.');
        $bag->set('street', str_random(40));
        $bag->set('zip_code', '00100');
        $bag->set('city', 'ROME');
        $bag->set('province', 'RM');
        $bag->set('country', 'IT');

        return $am->create($bag)->getResource();
    }

    /**
     * @return \Railken\LaraOre\Work\Work
     */
    public function newWork()
    {
        $am = new WorkManager();
        $bag = new Bag();
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\FileWorker');
        $bag->set('extra', [
            'filename' => "invoice-{{ invoice.id }}-{{ invoice.issued_at|date('Y-m-d') }}.pdf",
            'filetype' => 'application/pdf',
            'content'  => '# {{ invoice.number }}',
            'tags'     => 'pdf,invoice',
        ]);
        return $am->create($bag)->getResource();
    }


    /**
     * @return \Railken\LaraOre\InvoiceTax\InvoiceTax
     */
    public function newInvoiceTax()
    {
        $am = new InvoiceTaxManager();
        $bag = new Bag();
        $bag->set('name', 'Vat 22%');
        $bag->set('description', "Give me");
        $bag->set('calculator', 'x*0.22');

        return $am->findOrCreate($bag->toArray())->getResource();
    }


    /**
     * @return \Railken\LaraOre\Listener\Listener
     */
    public function newListener()
    {
        $am = new ListenerManager();
        $bag = new Bag();
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('work_id', $this->newWork()->id);
        $bag->set('event_class', 'Railken\LaraOre\Invoice\Events\InvoiceIssued');

        return $am->create($bag)->getResource();
    }

    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function newInvoice()
    {
        $im = new InvoiceManager();
        $bag = new Bag();
        $bag->set('number', '2/2018');
        $bag->set('name', 'a common name');
        $bag->set('country_iso', 'IT');
        $bag->set('currency', 'EUR');
        $bag->set('recipient_id', $this->newLegalEntity()->id);
        $bag->set('tax_id', $this->newInvoiceTax()->id);
        $bag->set('type_id', $this->newType()->id);
        $bag->set('sender_id', $this->newLegalEntity()->id);
        $bag->set('issued_at', '2018-01-01 00:00:00');
        $bag->set('expires_at', '2019-01-01 00:00:00');

        return $im->create($bag)->getResource();
    }


    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function getParameters()
    {
        $bag = new Bag();
        $bag->set('name', 'something');
        $bag->set('unit_name', 'kg');
        $bag->set('description', 'maybe');
        $bag->set('quantity', 10);
        $bag->set('price', 50);
        $bag->set('tax_id', $this->newInvoiceTax()->id);
        $bag->set('invoice_id', $this->newInvoice()->id);

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
