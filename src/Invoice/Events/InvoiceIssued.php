<?php
namespace Railken\LaraOre\Invoice\Events;

use Illuminate\Queue\SerializesModels;

class InvoiceIssued
{
    use SerializesModels;
    
    public $data;

    /**
     * @param array $data
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
