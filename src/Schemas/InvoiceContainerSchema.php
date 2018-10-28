<?php

namespace Railken\Amethyst\Schemas;

use Railken\Amethyst\Managers\InvoiceManager;
use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class InvoiceContainerSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\TextAttribute::make('name')
                ->setRequired(true),
            Attributes\LongTextAttribute::make('description'),
            Attributes\BelongsToAttribute::make('invoice_id')
                ->setRelationName('invoice')
                ->setRelationManager(InvoiceManager::class),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
