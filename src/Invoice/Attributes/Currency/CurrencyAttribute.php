<?php

namespace Railken\LaraOre\Invoice\Attributes\Currency;

use Illuminate\Support\Collection;
use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

class CurrencyAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'currency';

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
        Tokens::NOT_DEFINED    => Exceptions\InvoiceCurrencyNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\InvoiceCurrencyNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceCurrencyNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\InvoiceCurrencyNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'invoice.attributes.currency.fill',
        Tokens::PERMISSION_SHOW => 'invoice.attributes.currency.show',
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
        try {
            $country = (new \League\ISO3166\ISO3166())->alpha2($entity->country_iso);

            return Collection::make($country['currency'])->contains($value);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
