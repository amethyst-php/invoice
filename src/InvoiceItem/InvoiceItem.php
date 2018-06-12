<?php

namespace Railken\LaraOre\InvoiceItem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Taxonomy\Taxonomy;
use Railken\LaraOre\Invoice\Invoice;
use Railken\LaraOre\InvoiceTax\InvoiceTax;

use Money\Money;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Parser\IntlLocalizedDecimalParser;
use Money\Currencies\ISOCurrencies;
use MathParser\StdMathParser;
use MathParser\Interpreting\Evaluator;

class InvoiceItem extends Model implements EntityContract
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'quantity',
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
        return $this->belongsTo(InvoiceTax::class);
    }

    /**
     * @param  mixed  $value
     *
     * @return void
     */
    public function setPriceAttribute($value)
    {

        if (!$value instanceof Money) {

            $currencies = new ISOCurrencies();

            $numberFormatter = new \NumberFormatter($this->invoice->locale, \NumberFormatter::DECIMAL);
            $moneyParser = new IntlLocalizedDecimalParser($numberFormatter, $currencies);

            $value = $moneyParser->parse((string)$value, new Currency($this->invoice->currency));
        }

        $this->attributes['price'] = json_encode($value);
    }

    /**
     * @param  mixed  $value
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

    public function formatPrice($price)
    {
        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter($this->invoice->locale, \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($price);
    }

    public function getPriceTax()
    {
        $expression = $this->tax->calculator;

        $parser = new StdMathParser();
        $AST = $parser->parse($this->tax->calculator);
        $evaluator = new Evaluator();
        $evaluator->setVariables([ 'x' => $this->getPriceTaxable()->getAmount() ]);
        $value = $AST->accept($evaluator);

        return new Money($value, new Currency($this->invoice->currency));

    }

    public function getPriceTaxed()
    {
        return $this->getPriceTaxable()->add($this->getPriceTax());
    }

    public function getPriceTaxable()
    {
        return $this->price;
    }

}
