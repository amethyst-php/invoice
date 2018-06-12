<?php

namespace Railken\LaraOre\InvoiceTax\Attributes\Name\Exceptions;

use Railken\LaraOre\InvoiceTax\Exceptions\InvoiceTaxAttributeException;

class InvoiceTaxNameNotValidException extends InvoiceTaxAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'name';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICETAX_NAME_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
