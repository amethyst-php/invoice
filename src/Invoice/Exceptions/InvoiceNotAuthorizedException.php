<?php

namespace Railken\LaraOre\Invoice\Exceptions;

class InvoiceNotAuthorizedException extends InvoiceException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICE_NOT_AUTHORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
