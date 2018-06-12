<?php

namespace Railken\LaraOre\InvoiceItem\Attributes\InvoiceId\Exceptions;

use Railken\LaraOre\InvoiceItem\Exceptions\InvoiceItemAttributeException;

class InvoiceItemInvoiceIdNotUniqueException extends InvoiceItemAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'invoice_id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICEITEM_INVOICE_ID_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
