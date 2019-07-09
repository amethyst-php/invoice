<?php

namespace Amethyst\InvoiceNumber;

use Illuminate\Support\Facades\DB;
use Amethyst\Contracts\InvoiceNumberContract;
use Amethyst\Managers\InvoiceManager;
use Railken\Lem\Contracts\EntityContract;

class IncrementalWithYearInvoice implements InvoiceNumberContract
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
     * Validate number.
     *
     * @param EntityContract $entity
     * @param string         $number
     *
     * @return bool
     */
    public function validate(EntityContract $entity, $number)
    {
        return preg_match("/^([0-9]*)\/([0-9]){4}$/i", $number);
    }

    /**
     * Calculate next free number.
     *
     * @return string
     */
    public function calculateNextFreeNumber()
    {
        $year = (new \DateTime())->format('Y');

        /** @var \Amethyst\Models\InvoiceModel */
        $result = $this->getManager()
            ->getRepository()
            ->newQuery()
            ->where('number', 'like', '%/'.$year)
            ->orderBy(DB::raw("CAST(REPLACE(number, '/{$year}', '') AS DECIMAL(10,2))"), 'desc')
            ->first();

        $number = $result ? intval(str_replace("/{$year}", '', $result->number)) + 1 : 1;

        return $number.'/'.$year;
    }

    /**
     * Parse key.
     *
     * @return DB
     */
    public function parseKey()
    {
        return DB::raw('LPAD(number, 10, 0)');
    }
}
