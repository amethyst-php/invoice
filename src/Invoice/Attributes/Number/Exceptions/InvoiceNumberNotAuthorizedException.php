<?php

namespace Railken\LaraOre\Invoice\Attributes\Number\Exceptions;

use Railken\LaraOre\Invoice\Exceptions\InvoiceAttributeException;

class InvoiceNumberNotAuthorizedException extends InvoiceAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'number';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICE_NUMBER_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
