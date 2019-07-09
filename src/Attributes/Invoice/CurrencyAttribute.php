<?php

namespace Amethyst\Attributes\Invoice;

use Illuminate\Support\Collection;
use Railken\Lem\Attributes\TextAttribute;
use Railken\Lem\Contracts\EntityContract;

class CurrencyAttribute extends TextAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'currency';

    /**
     * Is a value valid ?
     *
     * @param \Railken\Lem\Contracts\EntityContract $entity
     * @param mixed                                 $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        try {
            $country = (new \League\ISO3166\ISO3166())->alpha2($entity->country);

            return Collection::make($country['currency'])->contains($value);
        } catch (\Exception $e) {
            return false;
        }
    }
}
