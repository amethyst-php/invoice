<?php

namespace Railken\LaraOre\InvoiceNumberManagers;

use Railken\LaraOre\Invoice\InvoiceManager;
use Illuminate\Support\Facades\DB;
use Railken\Laravel\Manager\Contracts\EntityContract;

class IncrementalWithYearManager implements ManagerContract
{
    /**
     * @var InvoiceManager
     */
    protected $manager;

    /**
     * @param InvoiceManager $manager
     */
    public function __construct(InvoiceManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return InvoiceManager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Validate number
     *
     * @param EntityContract $entity
     * @param string
     *
     * @return bool
     */
    public function validate(EntityContract $entity, $number)
    {
        return preg_match("/^([0-9]*)\/([0-9]){4}$/i", $number);
    }

    /**
     * Calculate next free number
     *
     * @return string
     */
    public function calculateNextFreeNumber()
    {
        $year = (new \DateTime())->format('Y');

        $result = $this->getManager()
            ->getRepository()
            ->newQuery()
            ->where('number', 'like', '%/'.$year)
            ->orderBy(DB::raw("CAST(REPLACE(number, '/{$year}', '') AS DECIMAL(10,2))"), 'desc')
            ->first();

        $number = $result ? intval(str_replace("/{$year}", "", $result->number))+1 : 1;

        return $number."/".$year;
    }

    /**
     * Parse key
     *
     * @return DB
     */
    public function parseKey()
    {
        return DB::raw("LPAD(number, 10, 0)");
    }
}
