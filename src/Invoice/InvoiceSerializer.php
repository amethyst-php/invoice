<?php

namespace Railken\LaraOre\Invoice;

use Illuminate\Support\Collection;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\ModelSerializer;

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

        $bag->set('files', $entity->files->map(function($file) {
            return [
                'url' => $file->media->first()->getFullUrl()
            ];
        }));

        return $bag;
    }
}
