<?php

namespace Railken\LaraOre\Invoice\Attributes\CountryIso\Exceptions;

use Railken\LaraOre\Invoice\Exceptions\InvoiceAttributeException;

class InvoiceCountryIsoNotAuthorizedException extends InvoiceAttributeException
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
    protected $code = 'INVOICE_COUNTRY_ISO_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
