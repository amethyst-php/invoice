<?php

namespace Railken\LaraOre\InvoiceTax;

use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;

class InvoiceTaxManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = InvoiceTax::class;

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
         Attributes\DeletedAt\DeletedAtAttribute::class,
         Attributes\Description\DescriptionAttribute::class,
         Attributes\Calculator\CalculatorAttribute::class,
        ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceTaxNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->setRepository(new InvoiceTaxRepository($this));
        $this->setSerializer(new InvoiceTaxSerializer($this));
        $this->setValidator(new InvoiceTaxValidator($this));
        $this->setAuthorizer(new InvoiceTaxAuthorizer($this));

        parent::__construct($agent);
    }
}
