<?php

namespace Railken\LaraOre\Invoice\Database\Seeds;

use Illuminate\Database\Seeder;
use Railken\Bag;
use Railken\LaraOre\Listener\ListenerManager;
use Railken\LaraOre\Work\WorkManager;

class ListenerInvoiceIssuedSeeder extends Seeder
{
    /**
     * @return \Railken\LaraOre\Work\Work
     */
    public function newWork()
    {
        $am = new WorkManager();
        $bag = new Bag();
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\FileWorker');
        $bag->set('mock_data', $this->getMockDataInvoice());
        $bag->set('extra', [
            'filename' => "invoice-{{ invoice.id }}-{{ invoice.issued_at|date('Y-m-d') }}.pdf",
            'filetype' => 'application/pdf',
            'content'  => file_get_contents(__DIR__.'/../../resources/views/invoice.html.twig'),
            'tags'     => 'pdf,invoice',
        ]);

        return $am->create($bag)->getResource();
    }

    /**
     * @return \Railken\LaraOre\Listener\Listener
     */
    public function newListener()
    {
        $am = new ListenerManager();
        $bag = new Bag();
        $bag->set('entities', 1);
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('work_id', $this->newWork()->id);
        $bag->set('event_class', 'Railken\LaraOre\Invoice\Events\InvoiceIssued');

        return $am->create($bag)->getResource();
    }

    /**
     * Return mock data invoice
     *
     * @return Bag
     */
    public function getMockDataInvoice()
    {

        $taxBag = new Bag();
        $taxBag->set('name', 'Vat 22%');
        $taxBag->set('description', 'Give me');
        $taxBag->set('calculator', 'x*0.22');

        $addressBag = new Bag();
        $addressBag->set('name', 'El. psy. congroo.');
        $addressBag->set('street', str_random(5));
        $addressBag->set('zip_code', '00100');
        $addressBag->set('city', 'ROME');
        $addressBag->set('province', 'RM');
        $addressBag->set('country', 'IT');


        $legalEntityBag = new Bag();
        $legalEntityBag->set('name', str_random(5));
        $legalEntityBag->set('notes', str_random(5));
        $legalEntityBag->set('country', 'IT');
        $legalEntityBag->set('vat_number', '203458239B01');
        $legalEntityBag->set('code_vat', '203458239B01');
        $legalEntityBag->set('code_tin', '203458239B01');
        $legalEntityBag->set('code_it_rea', '123');
        $legalEntityBag->set('code_it_sia', '123');
        $legalEntityBag->set('registered_office_address', $addressBag->all());

        $taxBag = new Bag();
        $taxBag->set('name', 'Vat 22%');
        $taxBag->set('description', 'Give me');
        $taxBag->set('calculator', 'x*0.22');

        $bag = new Bag();
        $bag->set('number', '1/2018');
        $bag->set('country', 'IT');
        $bag->set('locale', 'it_IT');
        $bag->set('currency', 'EUR');
        $bag->set('tax', $taxBag->all());
        $bag->set('recipient', $legalEntityBag->all());
        $bag->set('sender', $legalEntityBag->all());
        $bag->set('issued_at', '2018-01-01 00:00:00');
        $bag->set('expires_at', '2019-01-01 00:00:00');

        return $bag->toArray();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->newListener();

        return 1;
    }
}
