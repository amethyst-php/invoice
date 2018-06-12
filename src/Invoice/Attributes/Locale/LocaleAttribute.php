<?php

namespace Railken\LaraOre\Invoice\Attributes\Locale;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

class LocaleAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'locale';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = false;

    /**
     * Is the attribute unique.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * List of all exceptions used in validation.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_DEFINED    => Exceptions\InvoiceLocaleNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\InvoiceLocaleNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceLocaleNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\InvoiceLocaleNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'invoice.attributes.locale.fill',
        Tokens::PERMISSION_SHOW => 'invoice.attributes.locale.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param EntityContract $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return in_array($value, \ResourceBundle::getLocales(''));
    }
}
