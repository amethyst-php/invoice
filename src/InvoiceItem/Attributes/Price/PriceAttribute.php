<?php

namespace Railken\LaraOre\InvoiceItem\Attributes\Price;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class PriceAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'price';

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
        Tokens::NOT_DEFINED    => Exceptions\InvoiceItemPriceNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\InvoiceItemPriceNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceItemPriceNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\InvoiceItemPriceNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'invoiceitem.attributes.price.fill',
        Tokens::PERMISSION_SHOW => 'invoiceitem.attributes.price.show',
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
        return v::numeric()->validate($value);
    }
}
