<?php

namespace Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class InvoiceItemAuthorizer extends Authorizer
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
