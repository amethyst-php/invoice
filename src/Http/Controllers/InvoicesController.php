<?php

namespace Railken\LaraOre\Http\Controllers;

use Illuminate\Http\Request;
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

    public $queryable = [
        'id',
        'number',
        'sender_id',
        'recipient_id',
        'issued_at',
        'expires_at',
        'type_id',
        'country',
        'locale',
        'currency',
        'tax_id',
        'created_at',
        'updated_at',
    ];

    public $fillable = [
        'number',
        'sender_id',
        'sender',
        'recipient_id',
        'recipient',
        'issued_at',
        'expires_at',
        'type_id',
        'type',
        'country',
        'locale',
        'currency',
        'tax_id',
        'tax',
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

    /**
     * @param string $key
     *
     * @return string
     */
    public function parseKey($key)
    {
        if ($key === 'number') {
            return $this->getManager()->getNumberManager()->parseKey();
        }

        return parent::parseKey($key);
    }

    /**
     * Issue a resource.
     *
     * @param mixed                    $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function issue($id, Request $request)
    {
        $resource = $this->manager->getRepository()->findOneById($id);

        if (!$resource) {
            return $this->not_found();
        }

        $result = $this->manager->issue($resource);

        if ($result->ok()) {
            return $this->success([
                'resource' => $this->manager->serializer->serialize($result->getResource(), $this->keys->selectable)->all(),
            ]);
        }

        return $this->error([
            'errors' => $result->getSimpleErrors(),
        ]);
    }
}
