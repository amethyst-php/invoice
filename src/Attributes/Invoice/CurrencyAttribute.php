<?php

namespace Amethyst\Attributes\Invoice;

use League\ISO3166\ISO3166;
use Railken\Lem\Attributes\EnumAttribute;

class CurrencyAttribute extends EnumAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'currency';

    /**
     * Create a new instance.
     *
     * @param string $name
     * @param array  $options
     */
    public function __construct(string $name = null, array $options = [])
    {
        $options = [];

        foreach ((new ISO3166())->all() as $item) {
            $options = array_merge($options, $item['currency']);
        }

        parent::__construct($name, $options);
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return 'Enum';
    }
}
