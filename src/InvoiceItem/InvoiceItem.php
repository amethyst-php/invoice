<?php

namespace Railken\LaraOre\InvoiceItem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use MathParser\Interpreting\Evaluator;
use MathParser\StdMathParser;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Money\Parser\IntlLocalizedDecimalParser;
use Railken\LaraOre\Invoice\Invoice;
use Railken\LaraOre\Tax\Tax;
use Railken\LaraOre\Taxonomy\Taxonomy;
use Railken\Laravel\Manager\Contracts\EntityContract;

/**
 * @property public $name
 * @property public $description
 * @property public $price
 * @property public $quantity
 * @property public $invoice
 * @property public $tax
 */
class InvoiceItem extends Model implements EntityContract
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'price',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = Config::get('ore.invoice-item.table');
        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    /**
     * @param mixed $value
     *
     * @return void
     */
    public function setPriceAttribute($value)
    {
        if (!$value instanceof Money) {
            $currencies = new ISOCurrencies();

            $numberFormatter = new \NumberFormatter($this->invoice->locale, \NumberFormatter::DECIMAL);
            $moneyParser = new IntlLocalizedDecimalParser($numberFormatter, $currencies);

            $value = $moneyParser->parse((string) $value, new Currency($this->invoice->currency));
        }

        $this->attributes['price'] = json_encode($value);
    }

    /**
     * @param mixed $value
     *
     * @return void
     */
    public function getPriceAttribute($value)
    {
        if (!$value instanceof Money) {
            $value = json_decode($value);
            $value = new Money($value->amount, new Currency($this->invoice->currency));
        }

        return $value;
    }

    /**
     * Readable price
     *
     * @param Money $price
     *
     * @return string
     */
    public function formatPrice(Money $price)
    {
        return $this->invoice->formatPrice($price);
    }

    /**
     * Calculate the price tax
     *
     * @return Money
     */
    public function calculatePriceTax()
    {
        $expression = $this->tax->calculator;

        $parser = new StdMathParser();
        $AST = $parser->parse($this->tax->calculator);
        $evaluator = new Evaluator();
        $evaluator->setVariables(['x' => $this->calculatePriceTaxable()->getAmount()]);
        $value = $AST->accept($evaluator);

        return new Money($value, new Currency($this->invoice->currency));
    }

    /**
     * Calculate the price taxed
     *
     * @return Money
     */
    public function calculatePriceTaxed()
    {
        return $this->calculatePriceTaxable()->add($this->calculatePriceTax());
    }

    /**
     * Calculate the price taxable
     *
     * @return Money
     */
    public function calculatePriceTaxable()
    {
        return $this->price;
    }
}
