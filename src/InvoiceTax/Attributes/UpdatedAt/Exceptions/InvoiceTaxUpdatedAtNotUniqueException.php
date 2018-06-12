<?php

namespace Railken\LaraOre\InvoiceTax\Attributes\UpdatedAt\Exceptions;

use Railken\LaraOre\InvoiceTax\Exceptions\InvoiceTaxAttributeException;

class InvoiceTaxUpdatedAtNotUniqueException extends InvoiceTaxAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'updated_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICETAX_UPDATED_AT_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
