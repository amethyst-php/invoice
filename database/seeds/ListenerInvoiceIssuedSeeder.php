<?php

namespace Railken\LaraOre\Invoice\Database\Seeds;

use Illuminate\Database\Seeder;
use Railken\Bag;
use Railken\LaraOre\FileGenerator\FileGeneratorManager;
use Railken\LaraOre\Listener\ListenerManager;
use Railken\LaraOre\Repositories\InvoiceRepository;
use Railken\LaraOre\Work\WorkManager;

class ListenerInvoiceIssuedSeeder extends Seeder
{
    /**
     * @return \Railken\LaraOre\Work\Work
     */
    public function newWork()
    {
        $fgm = new FileGeneratorManager();
        $fg = $fgm->createOrFail([
            'name'         => 'PDF INVOICE',
            'description'  => 'Generate a .pdf file',
            'data_builder' => [
                'name'       => 'INVOICE BY ID',
                'repository' => [
                    'name'       => 'INVOICE BY ID',
                    'filter'     => 'id eq {{ id }}',
                    'class_name' => InvoiceRepository::class,
                ],
                'input', [
                    'id' => [
                        'type'       => 'text',
                        'validation' => 'integer',
                    ],
                ],
            ],
            'filename' => '{{ invoice.id }}.pdf',
            'filetype' => 'application/pdf',
            'body'     => file_get_contents(__DIR__.'/../../resources/views/invoice.html.twig'),
        ])->getResource();

        $am = new WorkManager();
        $bag = new Bag();
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\FileWorker');
        $bag->set('payload', [
            'class' => 'Railken\LaraOre\Workers\FileWorker',
            'data'  => [
                'id' => $fg->id,
            ],
        ]);

        return $am->createOrFail($bag)->getResource();
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
        $bag->set('data', [
            'id' => '{{ invoice.id }}',
        ]);
        $bag->set('event_class', 'Railken\LaraOre\Invoice\Events\InvoiceIssued');
        $bag->set('enabled', 1);

        return $am->createOrFail($bag)->getResource();
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->newListener();

        return 1;
    }
}
