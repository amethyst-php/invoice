<?php

namespace Amethyst\Events;

use Illuminate\Queue\SerializesModels;
use Amethyst\Models\Invoice;

class InvoiceIssued
{
    use SerializesModels;

    /**
     * @var \Amethyst\Models\Invoice
     */
    public $invoice;

    /**
     * @var array
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @param \Amethyst\Models\Invoice $invoice
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->data = ['invoice' => $invoice];
    }
}
