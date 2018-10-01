<?php

namespace Railken\Amethyst\Managers;

use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Events;
use Railken\Amethyst\Models\Invoice;
use Railken\Lem\Manager;

class InvoiceManager extends Manager
{
    /**
     * Describe this manager.
     *
     * @var string
     */
    public $comment = '...';

    /**
     * Register Classes.
     */
    public function registerClasses()
    {
        return Config::get('amethyst.invoice.managers.invoice');
    }

    public function getNumberManager()
    {
        $class = Config::get('amethyst.invoice.managers.invoice.number_manager');

        return new $class($this);
    }

    /**
     * Issue an invoice.
     *
     * @param Invoice $invoice
     *
     * @return \Railken\Laravel\Manager\ResultAction
     */
    public function issue(Invoice $invoice)
    {
        $result = $this->update($invoice, ['issued_at' => new \DateTime(), 'number' => $this->getNumberManager()->calculateNextFreeNumber()]);

        $result->ok() && event(new Events\InvoiceIssued($invoice));

        return $result;
    }
}
