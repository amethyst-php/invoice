<?php

namespace Railken\LaraOre\InvoiceItem\Attributes\Name\Exceptions;

use Railken\LaraOre\InvoiceItem\Exceptions\InvoiceItemAttributeException;

class InvoiceItemNameNotUniqueException extends InvoiceItemAttributeException
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
    protected $code = 'INVOICEITEM_NAME_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
