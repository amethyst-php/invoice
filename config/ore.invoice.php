<?php

return [

    'table' => 'ore_invoices',

    'number_manager' => \Railken\LaraOre\InvoiceNumberManagers\IncrementalWithYearManager::class,

    'router' => [
        'prefix'      => 'admin/invoices',
        'middlewares' => [
            \Railken\LaraOre\RequestLoggerMiddleware::class,
            'auth:api',
        ],
    ],
];
