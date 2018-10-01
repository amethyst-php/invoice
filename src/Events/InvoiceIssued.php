<?php

namespace Railken\Amethyst\Events;

use Illuminate\Queue\SerializesModels;
use Railken\Amethyst\Models\Invoice;

class InvoiceIssued
{
    use SerializesModels;

    /**
     * @var \Railken\Amethyst\Models\Invoice
     */
    public $invoice;

    /**
     * @var array
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @param \Railken\Amethyst\Models\Invoice $invoice
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->data = ['invoice' => $invoice];
    }
}
