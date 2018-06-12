<?php

return [

    'table' => 'ore_invoice_items',

    'unit_taxonomy' => 'INVOICE_ITEM_UNIT',

    'router' => [
        'prefix'      => 'admin/invoice-items',
        'middlewares' => [
            \Railken\LaraOre\RequestLoggerMiddleware::class,
            'auth:api',
        ],
    ],
];
