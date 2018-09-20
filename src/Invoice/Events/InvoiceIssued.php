<?php

namespace Railken\LaraOre\Invoice\Events;

use Illuminate\Queue\SerializesModels;
use Railken\LaraOre\Invoice\Invoice;

class InvoiceIssued
{
    use SerializesModels;

    /**
     * @var \Railken\LaraOre\Invoice\Invoice
     */
    public $invoice;

    /**
     * @var array
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @param \Railken\LaraOre\Invoice\Invoice $order
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->data = ['invoice' => $invoice];
    }
}
