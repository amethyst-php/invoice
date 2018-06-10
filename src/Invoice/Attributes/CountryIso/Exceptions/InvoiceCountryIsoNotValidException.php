<?php

namespace Railken\LaraOre\Invoice\Attributes\CountryIso\Exceptions;

use Railken\LaraOre\Invoice\Exceptions\InvoiceAttributeException;

class InvoiceCountryIsoNotValidException extends InvoiceAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'country_iso';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'INVOICE_COUNTRY_ISO_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
