<?php

namespace Railken\LaraOre\Invoice\Attributes\TypeId\Exceptions;

use Railken\LaraOre\Invoice\Exceptions\InvoiceAttributeException;

class InvoiceTypeIdNotAuthorizedException extends InvoiceAttributeException
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
    protected $code = 'INVOICE_TYPE_ID_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
