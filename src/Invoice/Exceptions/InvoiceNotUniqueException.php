<?php

namespace Railken\LaraOre\Invoice\Exceptions;

class InvoiceNotUniqueException extends InvoiceException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICE_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "Not unique";
}
