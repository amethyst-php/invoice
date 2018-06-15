<?php

return [

    'table' => 'ore_invoice_taxes',

    'router' => [
        'prefix'      => '/admin/invoice-taxes',
        'middlewares' => [
            \Railken\LaraOre\RequestLoggerMiddleware::class,
            'auth:api',
        ],
    ],
];
