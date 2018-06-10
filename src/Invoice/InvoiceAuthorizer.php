<?php

namespace Railken\LaraOre\Invoice;

use Railken\Laravel\Manager\ModelAuthorizer;
use Railken\Laravel\Manager\Tokens;

class InvoiceAuthorizer extends ModelAuthorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'invoice.create',
        Tokens::PERMISSION_UPDATE => 'invoice.update',
        Tokens::PERMISSION_SHOW   => 'invoice.show',
        Tokens::PERMISSION_REMOVE => 'invoice.remove',
    ];
}
