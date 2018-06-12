<?php

namespace Railken\LaraOre\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Railken\LaraOre\LegalEntity\LegalEntity;
use Railken\LaraOre\Taxonomy\Taxonomy;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\LaraOre\InvoiceTax\InvoiceTax;
use Railken\LaraOre\InvoiceItem\InvoiceItem;

use Money\Money;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Parser\IntlLocalizedDecimalParser;
use Money\Currencies\ISOCurrencies;

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
    use SoftDeletes;

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
        'deleted_at'
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
        return $this->belongsTo(InvoiceTax::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    
    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function formatPrice($price)
    {
        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($price);
    }

    public function getPriceTaxable()
    {
        $money = new Money(0, new Currency($this->currency));

        $this->items->map(function ($item) use (&$money) {
            $money = $money->add($item->getPriceTaxable());
        });

        return $money;
    }

    public function getPriceTax()
    {
        $money = new Money(0, new Currency($this->currency));

        $this->items->map(function ($item) use (&$money) {
            $money = $money->add($item->getPriceTax());
        });

        return $money;
    }

    public function getPriceTaxed()
    {
        $money = new Money(0, new Currency($this->currency));

        $this->items->map(function ($item) use (&$money) {
            $money = $money->add($item->getPriceTaxed());
        });

        return $money;
    }
}
