<?php

namespace Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class InvoiceAuthorizer extends Authorizer
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
