<?php

namespace Railken\LaraOre\Console\Commands;

use Illuminate\Console\Command;

class InvoiceInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lara-ore:invoice:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install lara-ore-invoice package';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        !file_exists(storage_path('/fonts')) && mkdir(storage_path('/fonts'), 0755);
        $this->call('db:seed', ['--class'   => 'Railken\LaraOre\Invoice\Database\Seeds\ListenerInvoiceIssuedSeeder']);
    }
}
