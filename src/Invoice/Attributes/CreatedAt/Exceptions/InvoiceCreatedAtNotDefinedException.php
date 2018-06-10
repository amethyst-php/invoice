<?php

namespace Railken\LaraOre\Invoice\Attributes\CreatedAt\Exceptions;

use Railken\LaraOre\Invoice\Exceptions\InvoiceAttributeException;

class InvoiceCreatedAtNotDefinedException extends InvoiceAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'created_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICE_CREATED_AT_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
