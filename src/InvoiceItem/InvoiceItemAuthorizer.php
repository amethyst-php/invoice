<?php

namespace Railken\LaraOre\InvoiceItem;

use Railken\Laravel\Manager\ModelAuthorizer;
use Railken\Laravel\Manager\Tokens;

class InvoiceItemAuthorizer extends ModelAuthorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'invoice_item.create',
        Tokens::PERMISSION_UPDATE => 'invoice_item.update',
        Tokens::PERMISSION_SHOW   => 'invoice_item.show',
        Tokens::PERMISSION_REMOVE => 'invoice_item.remove',
    ];
}
