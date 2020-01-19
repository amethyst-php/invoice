<?php

namespace Amethyst\Managers;

use Amethyst\Core\ConfigurableManager;
use Amethyst\Events;
use Amethyst\Models\Invoice;
use Illuminate\Support\Facades\Config;
use Railken\Lem\Manager;

/**
 * @method \Amethyst\Models\Invoice                 newEntity()
 * @method \Amethyst\Schemas\InvoiceSchema          getSchema()
 * @method \Amethyst\Repositories\InvoiceRepository getRepository()
 * @method \Amethyst\Serializers\InvoiceSerializer  getSerializer()
 * @method \Amethyst\Validators\InvoiceValidator    getValidator()
 * @method \Amethyst\Authorizers\InvoiceAuthorizer  getAuthorizer()
 */
class InvoiceManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.invoice.data.invoice';

    public function getNumberManager()
    {
        $class = Config::get('amethyst.invoice.data.invoice.number_manager');

        return new $class($this);
    }

    /**
     * Issue an invoice.
     *
     * @param Invoice $invoice
     *
     * @return \Railken\Lem\Result
     */
    public function issue(Invoice $invoice)
    {
        $result = $this->update($invoice, [
            'issued_at'  => new \DateTime(),
            'expires_at' => (new \DateTime())->modify('+1 month'),
            'number'     => $this->getNumberManager()->calculateNextFreeNumber(),
        ]);

        $result->ok() && event(new Events\InvoiceIssued($invoice));

        return $result;
    }
}
