<?php

namespace Railken\Amethyst\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Railken\Amethyst\Common\ConfigurableModel;
use Railken\Amethyst\Traits\HasFileTrait;
use Railken\Lem\Contracts\EntityContract;

/**
 * @property string      $number
 * @property DateTime    $issued_at
 * @property DateTime    $expires_at
 * @property string      $country
 * @property string      $currency
 * @property string      $locale
 * @property LegalEntity $sender
 * @property LegalEntity $recipient
 * @property Taxonomy    $type
 * @property Tax         $tax
 * @property Collection  $items
 */
class Invoice extends Model implements EntityContract
{
    use SoftDeletes, HasFileTrait, ConfigurableModel;

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
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->ini('amethyst.invoice.data.invoice');
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
     * Readable price.
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
     * Calculate the price tax.
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
     * Calculate the price tax.
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
     * Calculate the price tax.
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
