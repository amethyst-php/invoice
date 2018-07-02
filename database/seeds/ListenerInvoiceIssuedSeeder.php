<?php

namespace Railken\LaraOre\Invoice\Database\Seeds;

use Illuminate\Database\Seeder;
use Railken\Bag;
use Railken\LaraOre\Listener\ListenerManager;
use Railken\LaraOre\Work\WorkManager;
use Railken\LaraOre\LegalEntity\LegalEntityFaker;
use Railken\LaraOre\Tax\TaxFaker;


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
        $bag->set('mock_data', ['invoice' => $this->getMockDataInvoice()]);
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

        $bag = new Bag();
        $bag->set('number', '1/2018');
        $bag->set('country', 'IT');
        $bag->set('locale', 'it_IT');
        $bag->set('currency', 'EUR');
        $bag->set('tax', TaxFaker::make()->toArray());
        $bag->set('recipient', LegalEntityFaker::make()->toArray());
        $bag->set('sender', LegalEntityFaker::make()->toArray());
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
