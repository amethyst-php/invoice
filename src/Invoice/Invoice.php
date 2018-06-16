<?php

namespace Railken\LaraOre\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Railken\LaraOre\InvoiceItem\InvoiceItem;
use Railken\LaraOre\Tax\Tax;
use Railken\LaraOre\LegalEntity\LegalEntity;
use Railken\LaraOre\Taxonomy\Taxonomy;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\LaraOre\File\HasFileTrait;

/**
 * @property public $name
 * @property public $number
 * @property public $issued_at
 * @property public $expires_at
 * @property public $type_id
 * @property public $country_iso
 * @property public $currency
 * @property public $locale
 * @property public $items
 * @property public $sender
 * @property public $recipient
 * @property public $type
 * @property public $tax
 */
class Invoice extends Model implements EntityContract
{
    use SoftDeletes, hasFileTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'number',
        'issued_at',
        'expires_at',
        'type_id',
        'country_iso',
        'currency',
        'locale',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'issued_at',
        'expires_at',
        'deleted_at',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = Config::get('ore.invoice.table');
        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(LegalEntity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(LegalEntity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Readable price
     *
     * @param Money $price
     *
     * @return string
     */

    public function formatPrice($price)
    {
        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($price);
    }

    /**
     * Calculate the price tax
     *
     * @return Money
     */
    public function calculatePriceTaxable()
    {
        $money = new Money(0, new Currency($this->currency));

        $this->items->map(function ($item) use (&$money) {
            $money = $money->add($item->calculatePriceTaxable());
        });

        return $money;
    }

    /**
     * Calculate the price tax
     *
     * @return Money
     */
    public function calculatePriceTax()
    {
        $money = new Money(0, new Currency($this->currency));

        $this->items->map(function ($item) use (&$money) {
            $money = $money->add($item->calculatePriceTax());
        });

        return $money;
    }

    /**
     * Calculate the price tax
     *
     * @return Money
     */
    public function calculatePriceTaxed()
    {
        $money = new Money(0, new Currency($this->currency));

        $this->items->map(function ($item) use (&$money) {
            $money = $money->add($item->calculatePriceTaxed());
        });

        return $money;
    }
}
