<?php

namespace Railken\LaraOre\Http\Controllers;

use Railken\LaraOre\Api\Http\Controllers\RestController;
use Railken\LaraOre\Api\Http\Controllers\Traits as RestTraits;
use Railken\LaraOre\InvoiceItem\InvoiceItemManager;

class InvoiceItemsController extends RestController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestRemoveTrait;

    public $queryable = [
        'id',
        'name',
        'description',
        'unit_id',
        'unit',
        'price',
        'quantity',
        'invoice_id',
        'tax_id',
        'invoice',
        'created_at',
        'updated_at',
    ];

    public $fillable = [
        'name',
        'description',
        'unit_id',
        'unit',
        'price',
        'quantity',
        'invoice_id',
        'invoice',
        'tax_id',
    ];

    /**
     * Construct.
     */
    public function __construct(InvoiceItemManager $manager)
    {
        $this->manager = $manager;
        $this->manager->setAgent($this->getUser());
        parent::__construct();
    }

    /**
     * Create a new instance for query.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getQuery()
    {
        return $this->manager->repository->getQuery();
    }
}
