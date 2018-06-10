<?php

namespace Railken\LaraOre\Invoice;

use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;
use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Vocabulary\VocabularyManager;

class InvoiceManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = Invoice::class;

    /**
     * @var array
     */
    protected $unique = [
        'sender_number' => ['sender_id', 'number']
    ];

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
        Attributes\RecipientId\RecipientIdAttribute::class,
        Attributes\SenderId\SenderIdAttribute::class,
        Attributes\Number\NumberAttribute::class,
        Attributes\IssuedAt\IssuedAtAttribute::class,
        Attributes\ExpiresAt\ExpiresAtAttribute::class,
        Attributes\TypeId\TypeIdAttribute::class,
        Attributes\CountryIso\CountryIsoAttribute::class,
        Attributes\Currency\CurrencyAttribute::class,
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceNotAuthorizedException::class,
        Tokens::NOT_UNIQUE => Exceptions\InvoiceNotUniqueException::class,
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

    public function getNumberManager()
    {
        $class = Config::get('ore.invoice.number_manager');
        return new $class($this);
    }

    /**
     * Retrieve the vocabulary used for the taxonomy attribute.
     *
     * @return \Railken\LaraOre\Vocabulary\Vocabulary
     */
    public function getTaxonomyVocabulary()
    {
        $vocabulary_name = Config::get('ore.invoice.taxonomy');

        $vm = new VocabularyManager();
        $resource = $vm->getRepository()->findOneBy(['name' => $vocabulary_name]);

        if (!$resource) {
            $result = $vm->create(['name' => $vocabulary_name]);

            if (!$result->ok()) {
                throw new \Exception(sprintf('Something did wrong while retrieving vocabulary %s, errors: %s', $vocabulary_name, json_encode($result->getSimpleErrors())));
            }

            $resource = $result->getResource();
        }

        return $resource;
    }
}
