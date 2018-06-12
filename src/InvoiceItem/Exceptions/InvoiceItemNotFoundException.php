<?php

namespace Railken\LaraOre\InvoiceItem\Exceptions;

class InvoiceItemNotFoundException extends InvoiceItemException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICEITEM_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Not found';
}
