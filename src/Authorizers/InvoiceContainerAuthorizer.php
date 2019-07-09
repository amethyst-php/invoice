<?php

namespace Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class InvoiceContainerAuthorizer extends Authorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'invoice-container.create',
        Tokens::PERMISSION_UPDATE => 'invoice-container.update',
        Tokens::PERMISSION_SHOW   => 'invoice-container.show',
        Tokens::PERMISSION_REMOVE => 'invoice-container.remove',
    ];
}
