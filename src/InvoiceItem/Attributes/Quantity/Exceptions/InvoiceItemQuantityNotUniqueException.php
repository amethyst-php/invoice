<?php

namespace Railken\LaraOre\InvoiceItem\Attributes\Quantity\Exceptions;

use Railken\LaraOre\InvoiceItem\Exceptions\InvoiceItemAttributeException;

class InvoiceItemQuantityNotUniqueException extends InvoiceItemAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'quantity';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICEITEM_QUANTITY_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
