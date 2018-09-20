<?php

namespace Railken\LaraOre\Repositories;

use Closure;
use Illuminate\Support\Collection;
use Railken\LaraOre\Contracts\RepositoryContract;
use Railken\LaraOre\Invoice\InvoiceManager;

class InvoiceRepository implements RepositoryContract
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new InvoiceManager();
    }

    public function newQuery()
    {
        return $this->manager->getRepository()->newQuery();
    }

    public function getTableName()
    {
        return $this->manager->newEntity()->getTable();
    }

    /**
     * @param Collection $resources
     * @param \Closure   $callback
     */
    public function extract(Collection $resources, Closure $callback)
    {
        foreach ($resources as $resource) {
            $callback($resource, ['invoice' => $resource]);
        }
    }

    /**
     * @param Collection $resources
     */
    public function parse(Collection $resources)
    {
        return ['invoices' => $resources];
    }
}
