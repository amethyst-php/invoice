<?php

namespace Railken\LaraOre\Invoice;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\ModelSerializer;
use Railken\Laravel\Manager\Tokens;

class InvoiceSerializer extends ModelSerializer
{
    /**
     * Serialize entity.
     *
     * @param EntityContract $entity
     * @param Collection     $select
     *
     * @return array
     */
    public function serialize(EntityContract $entity, Collection $select = null)
    {
        $bag = parent::serialize($entity, $select);

        // ...

        return $bag;
    }
}
