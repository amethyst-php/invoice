<?php

namespace Railken\LaraOre\InvoiceItem;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\ModelSerializer;
use Railken\Laravel\Manager\Tokens;

class InvoiceItemSerializer extends ModelSerializer
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
        
        $select && $select->contains('unit_name') &&
        $this->getManager()->authorizer->getAuthorizedAttributes(Tokens::PERMISSION_SHOW, $entity)->has('unit_id') &&
        $bag->set('unit_name', $entity->unit->name);

        return $bag;
    }
}
