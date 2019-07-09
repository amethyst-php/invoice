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
            'model'          => Amethyst\Models\Invoice::class,
            'schema'         => Amethyst\Schemas\InvoiceSchema::class,
            'repository'     => Amethyst\Repositories\InvoiceRepository::class,
            'serializer'     => Amethyst\Serializers\InvoiceSerializer::class,
            'validator'      => Amethyst\Validators\InvoiceValidator::class,
            'authorizer'     => Amethyst\Authorizers\InvoiceAuthorizer::class,
            'faker'          => Amethyst\Fakers\InvoiceFaker::class,
            'manager'        => Amethyst\Managers\InvoiceManager::class,
            'number_manager' => \Amethyst\InvoiceNumber\IncrementalWithYearInvoice::class,
        ],
        'invoice-container' => [
            'table'      => 'amethyst_invoice_containers',
            'comment'    => 'Invoice Container',
            'model'      => Amethyst\Models\InvoiceContainer::class,
            'schema'     => Amethyst\Schemas\InvoiceContainerSchema::class,
            'repository' => Amethyst\Repositories\InvoiceContainerRepository::class,
            'serializer' => Amethyst\Serializers\InvoiceContainerSerializer::class,
            'validator'  => Amethyst\Validators\InvoiceContainerValidator::class,
            'authorizer' => Amethyst\Authorizers\InvoiceContainerAuthorizer::class,
            'faker'      => Amethyst\Fakers\InvoiceContainerFaker::class,
            'manager'    => Amethyst\Managers\InvoiceContainerManager::class,
        ],
        'invoice-item' => [
            'table'      => 'amethyst_invoice_items',
            'comment'    => 'Invoice Item',
            'model'      => Amethyst\Models\InvoiceItem::class,
            'schema'     => Amethyst\Schemas\InvoiceItemSchema::class,
            'repository' => Amethyst\Repositories\InvoiceItemRepository::class,
            'serializer' => Amethyst\Serializers\InvoiceItemSerializer::class,
            'validator'  => Amethyst\Validators\InvoiceItemValidator::class,
            'authorizer' => Amethyst\Authorizers\InvoiceItemAuthorizer::class,
            'faker'      => Amethyst\Fakers\InvoiceItemFaker::class,
            'manager'    => Amethyst\Managers\InvoiceItemManager::class,
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
                'controller' => Amethyst\Http\Controllers\Admin\InvoicesController::class,
                'router'     => [
                    'as'     => 'invoice.',
                    'prefix' => '/invoices',
                ],
            ],
            'invoice-container' => [
                'enabled'    => true,
                'controller' => Amethyst\Http\Controllers\Admin\InvoiceContainersController::class,
                'router'     => [
                    'as'     => 'invoice-container.',
                    'prefix' => '/invoice-containers',
                ],
            ],
            'invoice-item' => [
                'enabled'    => true,
                'controller' => Amethyst\Http\Controllers\Admin\InvoiceItemsController::class,
                'router'     => [
                    'as'     => 'invoice-item.',
                    'prefix' => '/invoice-items',
                ],
            ],
        ],
    ],
];
