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
            Attributes\TextAttribute::make('name')
                ->setRequired(true),
            Attributes\LongTextAttribute::make('description'),
            Attributes\BelongsToAttribute::make('invoice_id')
                ->setRelationName('invoice')
                ->setRelationManager(InvoiceManager::class)
                ->setRequired(true),
            Attributes\BelongsToAttribute::make('invoice_container_id')
                ->setRelationName('invoice_container')
                ->setRelationManager(InvoiceContainerManager::class)
                ->setRequired(true),
            Attributes\BelongsToAttribute::make('tax_id')
                ->setRelationName('tax')
                ->setRelationManager(TaxManager::class)
                ->setRequired(true),
            AmethystAttributes\TaxonomyAttribute::make('unit_id', Config::get('amethyst.invoice.data.invoice-item.unit_taxonomy'))
                ->setRelationName('unit')
                ->setRequired(true),
            Attributes\NumberAttribute::make('price')
                ->setRequired(true),
            Attributes\NumberAttribute::make('quantity')
                ->setRequired(true),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
