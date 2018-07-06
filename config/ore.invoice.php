<?php

return [

    'table' => 'ore_invoices',

    'number_manager' => \Railken\LaraOre\InvoiceNumberManagers\IncrementalWithYearManager::class,

    'taxonomy' => 'INVOICE_TYPE',

    'router' => [
        'prefix'      => '/admin/invoices',
    ],
];
