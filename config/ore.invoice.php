<?php

return [
    'table' => 'ore_invoices',

    'number_manager' => \Railken\LaraOre\InvoiceNumberManagers\IncrementalWithYearManager::class,

    'taxonomy' => 'INVOICE_TYPE',

    /*
    |--------------------------------------------------------------------------
    | Http configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the routes
    |
    */
    'http' => [
        'admin' => [
            'enabled'    => true,
            'controller' => Railken\LaraOre\Http\Controllers\Admin\InvoicesController::class,
            'router'     => [
                'prefix'      => '/invoices',
            ],
        ],
    ],
];
