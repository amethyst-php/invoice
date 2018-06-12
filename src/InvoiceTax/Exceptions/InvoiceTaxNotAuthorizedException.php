<?php

namespace Railken\LaraOre\InvoiceTax\Exceptions;

class InvoiceTaxNotAuthorizedException extends InvoiceTaxException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICETAX_NOT_AUTHORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
