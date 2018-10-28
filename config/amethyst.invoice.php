<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    |
    | Here you can change the table name and the class components.
    |
    */
    'data' => [
        'invoice' => [
            'table'          => 'amethyst_invoices',
            'comment'        => 'Invoice',
            'model'          => Railken\Amethyst\Models\Invoice::class,
            'schema'         => Railken\Amethyst\Schemas\InvoiceSchema::class,
            'repository'     => Railken\Amethyst\Repositories\InvoiceRepository::class,
            'serializer'     => Railken\Amethyst\Serializers\InvoiceSerializer::class,
            'validator'      => Railken\Amethyst\Validators\InvoiceValidator::class,
            'authorizer'     => Railken\Amethyst\Authorizers\InvoiceAuthorizer::class,
            'faker'          => Railken\Amethyst\Fakers\InvoiceFaker::class,
            'manager'        => Railken\Amethyst\Managers\InvoiceManager::class,
            'number_manager' => \Railken\Amethyst\InvoiceNumber\IncrementalWithYearInvoice::class,
            'taxonomy'       => 'INVOICE_TYPE',
        ],
        'invoice-item' => [
            'table'         => 'amethyst_invoice_items',
            'comment'       => 'Invoice Item',
            'model'         => Railken\Amethyst\Models\InvoiceItem::class,
            'schema'        => Railken\Amethyst\Schemas\InvoiceItemSchema::class,
            'repository'    => Railken\Amethyst\Repositories\InvoiceItemRepository::class,
            'serializer'    => Railken\Amethyst\Serializers\InvoiceItemSerializer::class,
            'validator'     => Railken\Amethyst\Validators\InvoiceItemValidator::class,
            'authorizer'    => Railken\Amethyst\Authorizers\InvoiceItemAuthorizer::class,
            'faker'         => Railken\Amethyst\Fakers\InvoiceItemFaker::class,
            'manager'       => Railken\Amethyst\Managers\InvoiceItemManager::class,
            'unit_taxonomy' => 'INVOICE_ITEM_UNIT',
        ],
    ],

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
            'invoice' => [
                'enabled'     => true,
                'controller'  => Railken\Amethyst\Http\Controllers\Admin\InvoicesController::class,
                'router'      => [
                    'as'        => 'invoice.',
                    'prefix'    => '/invoices',
                ],
            ],
            'invoice-item' => [
                'enabled'     => true,
                'controller'  => Railken\Amethyst\Http\Controllers\Admin\InvoiceItemsController::class,
                'router'      => [
                    'as'        => 'invoice-item.',
                    'prefix'    => '/invoice-items',
                ],
            ],
        ],
    ],
];
