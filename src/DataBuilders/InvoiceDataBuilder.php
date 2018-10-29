<?php

namespace Railken\Amethyst\DataBuilders;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Railken\Amethyst\Contracts\DataBuilderContract;
use Railken\Amethyst\Managers\InvoiceManager;

class InvoiceDataBuilder implements DataBuilderContract
{
    /**
     * @var \Railken\Amethyst\Managers\InvoiceManager
     */
    protected $manager;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->manager = new InvoiceManager();
    }

    /**
     * Get manager
     *
     * @return \Railken\Amethyst\Managers\InvoiceManager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Create a new instance of the query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery(): Builder
    {
        return $this->manager->getRepository()->newQuery();
    }

    /**
     * Retrieve the table name.
     *
     * @return string
     */
    public function getTableName(): string
    {
        return $this->manager->newEntity()->getTable();
    }

    /**
     * Extract a single resource.
     *
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
     * Parse collection of resources.
     *
     * @param Collection $resources
     *
     * @return Collection
     */
    public function parse(Collection $resources): Collection
    {
        return new Collection(['invoices' => $resources]);
    }
}
