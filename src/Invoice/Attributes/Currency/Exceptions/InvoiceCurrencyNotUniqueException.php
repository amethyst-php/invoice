<?php

namespace Railken\LaraOre\Invoice\Attributes\Currency\Exceptions;

use Railken\LaraOre\Invoice\Exceptions\InvoiceAttributeException;

class InvoiceCurrencyNotUniqueException extends InvoiceAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'currency';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICE_CURRENCY_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
