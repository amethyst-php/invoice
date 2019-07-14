<?php

namespace Amethyst\Managers;

use Amethyst\Common\ConfigurableManager;
use Railken\Lem\Manager;

/**
 * @method \Amethyst\Models\InvoiceItem                 newEntity()
 * @method \Amethyst\Schemas\InvoiceItemSchema          getSchema()
 * @method \Amethyst\Repositories\InvoiceItemRepository getRepository()
 * @method \Amethyst\Serializers\InvoiceItemSerializer  getSerializer()
 * @method \Amethyst\Validators\InvoiceItemValidator    getValidator()
 * @method \Amethyst\Authorizers\InvoiceItemAuthorizer  getAuthorizer()
 */
class InvoiceItemManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.invoice.data.invoice-item';
}
