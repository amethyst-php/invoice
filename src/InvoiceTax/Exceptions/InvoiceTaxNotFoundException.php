<?php

namespace Railken\LaraOre\InvoiceTax\Exceptions;

class InvoiceTaxNotFoundException extends InvoiceTaxException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICETAX_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Not found';
}
