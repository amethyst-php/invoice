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
        ],
        'invoice-container' => [
            'table'      => 'amethyst_invoice_containers',
            'comment'    => 'Invoice Container',
            'model'      => Railken\Amethyst\Models\InvoiceContainer::class,
            'schema'     => Railken\Amethyst\Schemas\InvoiceContainerSchema::class,
            'repository' => Railken\Amethyst\Repositories\InvoiceContainerRepository::class,
            'serializer' => Railken\Amethyst\Serializers\InvoiceContainerSerializer::class,
            'validator'  => Railken\Amethyst\Validators\InvoiceContainerValidator::class,
            'authorizer' => Railken\Amethyst\Authorizers\InvoiceContainerAuthorizer::class,
            'faker'      => Railken\Amethyst\Fakers\InvoiceContainerFaker::class,
            'manager'    => Railken\Amethyst\Managers\InvoiceContainerManager::class,
        ],
        'invoice-item' => [
            'table'      => 'amethyst_invoice_items',
            'comment'    => 'Invoice Item',
            'model'      => Railken\Amethyst\Models\InvoiceItem::class,
            'schema'     => Railken\Amethyst\Schemas\InvoiceItemSchema::class,
            'repository' => Railken\Amethyst\Repositories\InvoiceItemRepository::class,
            'serializer' => Railken\Amethyst\Serializers\InvoiceItemSerializer::class,
            'validator'  => Railken\Amethyst\Validators\InvoiceItemValidator::class,
            'authorizer' => Railken\Amethyst\Authorizers\InvoiceItemAuthorizer::class,
            'faker'      => Railken\Amethyst\Fakers\InvoiceItemFaker::class,
            'manager'    => Railken\Amethyst\Managers\InvoiceItemManager::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here you may configure taxonomies
    |
    */
    'taxonomies' => [
        ['name' => 'INVOICE_TYPE'],
        ['name' => 'INVOICE_ITEM_UNIT'],
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
                'enabled'    => true,
                'controller' => Railken\Amethyst\Http\Controllers\Admin\InvoicesController::class,
                'router'     => [
                    'as'     => 'invoice.',
                    'prefix' => '/invoices',
                ],
            ],
            'invoice-container' => [
                'enabled'    => true,
                'controller' => Railken\Amethyst\Http\Controllers\Admin\InvoiceContainersController::class,
                'router'     => [
                    'as'     => 'invoice-container.',
                    'prefix' => '/invoice-containers',
                ],
            ],
            'invoice-item' => [
                'enabled'    => true,
                'controller' => Railken\Amethyst\Http\Controllers\Admin\InvoiceItemsController::class,
                'router'     => [
                    'as'     => 'invoice-item.',
                    'prefix' => '/invoice-items',
                ],
            ],
        ],
    ],
];
