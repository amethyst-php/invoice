<?php

namespace Railken\LaraOre\InvoiceTax;

use Railken\Laravel\Manager\ModelAuthorizer;
use Railken\Laravel\Manager\Tokens;

class InvoiceTaxAuthorizer extends ModelAuthorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'invoice_tax.create',
        Tokens::PERMISSION_UPDATE => 'invoice_tax.update',
        Tokens::PERMISSION_SHOW   => 'invoice_tax.show',
        Tokens::PERMISSION_REMOVE => 'invoice_tax.remove',
    ];
}
