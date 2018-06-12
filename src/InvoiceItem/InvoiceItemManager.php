<?php

namespace Railken\LaraOre\InvoiceItem;

use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;
use Railken\LaraOre\Vocabulary\VocabularyManager;
use Illuminate\Support\Facades\Config;

class InvoiceItemManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = InvoiceItem::class;
    
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
        Attributes\InvoiceId\InvoiceIdAttribute::class,
        Attributes\UnitId\UnitIdAttribute::class,
        Attributes\Description\DescriptionAttribute::class,
        Attributes\Price\PriceAttribute::class,
        Attributes\Quantity\QuantityAttribute::class
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceItemNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->setRepository(new InvoiceItemRepository($this));
        $this->setSerializer(new InvoiceItemSerializer($this));
        $this->setValidator(new InvoiceItemValidator($this));
        $this->setAuthorizer(new InvoiceItemAuthorizer($this));

        parent::__construct($agent);
    }

    /**
     * Retrieve the vocabulary used for the taxonomy attribute.
     *
     * @return \Railken\LaraOre\Vocabulary\Vocabulary
     */
    public function getTaxonomyItemVocabulary()
    {
        $vocabulary_name = Config::get('ore.invoice-item.unit_taxonomy');

        $vm = new VocabularyManager();
        $result = $vm->findOrCreate(['name' => $vocabulary_name]);

        if (!$result->ok()) {
            throw new \Exception(sprintf('Something did wrong while retrieving vocabulary %s, errors: %s', $vocabulary_name, json_encode($result->getSimpleErrors())));
        }

        return $result->getResource();
    }
}
