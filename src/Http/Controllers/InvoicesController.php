<?php

namespace Railken\LaraOre\Http\Controllers;

use Railken\LaraOre\Api\Http\Controllers\RestController;
use Railken\LaraOre\Api\Http\Controllers\Traits as RestTraits;
use Railken\LaraOre\Invoice\InvoiceManager;

class InvoicesController extends RestController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestRemoveTrait;

    protected static $query = [
        'id',
        'name',
        'number',
        'sender_id',
        'recipient_id',
        'issued_at',
        'expires_at',
        'type_id',
        'country_iso',
        'locale',
        'currency',
        'tax_id',
        'created_at',
        'updated_at',
    ];

    protected static $fillable = [
        'name',
        'number',
        'sender_id',
        'recipient_id',
        'issued_at',
        'expires_at',
        'type_id',
        'country_iso',
        'locale',
        'currency',
        'tax_id',
    ];

    /**
     * Construct.
     */
    public function __construct(InvoiceManager $manager)
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

    public function parseKey($key)
    {
        if ($key === 'number') {
            return $this->getManager()->getNumberManager()->parseKey();
        }

        return parent::parseKey($key);
    }
}
