<?php

namespace Railken\LaraOre\Invoice;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Vocabulary\VocabularyManager;
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
     * @var array
     */
    protected $unique = [
        'sender_number' => ['sender_id', 'number'],
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
        Attributes\TaxId\TaxIdAttribute::class,
        Attributes\Locale\LocaleAttribute::class,
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\InvoiceNotUniqueException::class,
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
        return (new VocabularyManager())->findOrCreateOrFail(['name' => Config::get('ore.invoice.taxonomy')])->getResource();
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

        $result->ok() && event(new Events\InvoiceIssued([
            'invoice' => $invoice,
        ]));

        return $result;
    }
}
