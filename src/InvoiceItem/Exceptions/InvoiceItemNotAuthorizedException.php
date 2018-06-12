<?php

namespace Railken\LaraOre\InvoiceItem\Exceptions;

class InvoiceItemNotAuthorizedException extends InvoiceItemException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICEITEM_NOT_AUTHORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
