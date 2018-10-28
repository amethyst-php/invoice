<?php

namespace Railken\Amethyst\Schemas;

use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Attributes as AmethystAttributes;
use Railken\Amethyst\Managers\InvoiceContainerManager;
use Railken\Amethyst\Managers\InvoiceManager;
use Railken\Amethyst\Managers\TaxManager;
use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class InvoiceItemSchema extends Schema
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
            Attributes\TextAttribute::make('name'),
            Attributes\LongTextAttribute::make('description'),
            Attributes\BelongsToAttribute::make('invoice_id')
                ->setRelationName('invoice')
                ->setRelationManager(InvoiceManager::class),
            Attributes\BelongsToAttribute::make('invoice_container_id')
                ->setRelationName('invoice_container')
                ->setRelationManager(InvoiceContainerManager::class),
            Attributes\BelongsToAttribute::make('tax_id')
                ->setRelationName('tax')
                ->setRelationManager(TaxManager::class),
            AmethystAttributes\TaxonomyAttribute::make('unit_id', Config::get('amethyst.invoice.data.invoice-item.unit_taxonomy'))
                ->setRelationName('unit'),
            Attributes\NumberAttribute::make('price'),
            Attributes\NumberAttribute::make('quantity'),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
