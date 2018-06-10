<?php

return [

    'table' => 'ore_invoices',

    'router' => [
        'prefix'      => 'admin/invoices',
        'middlewares' => [
            \Railken\LaraOre\RequestLoggerMiddleware::class,
            'auth:api',
        ],
    ],
];
