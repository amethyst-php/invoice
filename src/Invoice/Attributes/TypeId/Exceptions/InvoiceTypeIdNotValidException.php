<?php

namespace Railken\LaraOre\Invoice\Attributes\TypeId\Exceptions;

use Railken\LaraOre\Invoice\Exceptions\InvoiceAttributeException;

class InvoiceTypeIdNotValidException extends InvoiceAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'type_id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICE_TYPE_ID_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
