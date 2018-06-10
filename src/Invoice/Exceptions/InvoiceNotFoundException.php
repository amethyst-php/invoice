<?php

namespace Railken\LaraOre\Invoice\Exceptions;

class InvoiceNotFoundException extends InvoiceException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICE_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Not found';
}
