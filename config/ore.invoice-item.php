<?php

return [
    'table' => 'ore_invoice_items',

    'unit_taxonomy' => 'INVOICE_ITEM_UNIT',

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
            'controller' => Railken\LaraOre\Http\Controllers\Admin\InvoiceItemsController::class,
            'router'     => [
                'prefix'      => '/admin/invoice-items',
            ],
        ],
    ],
];
