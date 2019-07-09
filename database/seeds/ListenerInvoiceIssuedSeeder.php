<?php

namespace Amethyst\Database\Seeds;

use Illuminate\Database\Seeder;
use Amethyst\DataBuilders\CommonDataBuilder;
use Amethyst\Fakers\WorkFaker;
use Amethyst\Managers\FileGeneratorManager;
use Amethyst\Managers\InvoiceManager;
use Amethyst\Managers\ListenerManager;
use Amethyst\Managers\WorkManager;
use Railken\Bag;
use Symfony\Component\Yaml\Yaml;

class ListenerInvoiceIssuedSeeder extends Seeder
{
    /**
     * @return \Amethyst\Models\Work
     */
    public function newWork()
    {
        $fgm = new FileGeneratorManager();
        $fg = $fgm->createOrFail([
            'name'         => 'Generate an invoice.pdf',
            'description'  => 'Generate a .pdf file',
            'data_builder' => [
                'name'            => 'InvoiceById',
                'filter'          => 'id eq {{ id }}',
                'class_name'      => CommonDataBuilder::class,
                'class_arguments' => Yaml::dump([InvoiceManager::class]),
                'input'           => Yaml::dump([
                    'id' => [
                        'type'       => 'text',
                        'validation' => 'integer',
                    ],
                ]),
                'mock_data' => Yaml::dump([
                    'id' => 1,
                ]),
            ],
            'filename' => '{{ invoice.id }}.pdf',
            'filetype' => 'application/pdf',
            'body'     => file_get_contents(__DIR__.'/../../resources/views/invoice.html.twig'),
        ])->getResource();

        $am = new WorkManager();
        $bag = WorkFaker::make()->parameters();
        $bag->set('name', 'Create an invoice');
        $bag->set('payload', Yaml::dump([
            'class' => 'Amethyst\Workers\FileWorker',
            'data'  => [
                'id' => $fg->id,
            ],
        ]));

        return $am->createOrFail($bag)->getResource();
    }

    /**
     * @return \Amethyst\Listener\Listener
     */
    public function newListener()
    {
        $am = new ListenerManager();
        $bag = new Bag();
        $bag->set('name', 'Create an invoice.pdf file when invoice is issued');
        $bag->set('work_id', $this->newWork()->id);
        $bag->set('data', [
            'id' => '{{ invoice.id }}',
        ]);
        $bag->set('event_class', 'Amethyst\Events\InvoiceIssued');
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
