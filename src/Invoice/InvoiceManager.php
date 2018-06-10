<?php

namespace Railken\LaraOre\Invoice;

use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;

class InvoiceManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = Invoice::class;
    
    /**
     * List of all attributes.
     *
     * @var array
     */
    protected $attributes = [
        Attributes\Id\IdAttribute::class,
        Attributes\Name\NameAttribute::class,
        Attributes\CreatedAt\CreatedAtAttribute::class,
        Attributes\UpdatedAt\UpdatedAtAttribute::class,
        Attributes\DeletedAt\DeletedAtAttribute::class
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->setRepository(new InvoiceRepository($this));
        $this->setSerializer(new InvoiceSerializer($this));
        $this->setValidator(new InvoiceValidator($this));
        $this->setAuthorizer(new InvoiceAuthorizer($this));

        parent::__construct($agent);
    }
}
