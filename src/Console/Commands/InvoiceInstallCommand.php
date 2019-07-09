<?php

namespace Amethyst\Console\Commands;

use Illuminate\Console\Command;

class InvoiceInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amethyst:invoice:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install amethyst-invoice package';

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
        $this->call('db:seed', ['--class' => 'Amethyst\Database\Seeds\ListenerInvoiceIssuedSeeder']);
    }
}
