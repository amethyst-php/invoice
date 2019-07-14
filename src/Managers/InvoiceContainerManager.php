<?php

namespace Amethyst\Managers;

use Amethyst\Common\ConfigurableManager;
use Railken\Lem\Manager;

/**
 * @method \Amethyst\Models\InvoiceContainer newEntity()
 * @method \Amethyst\Schemas\InvoiceContainerSchema getSchema()
 * @method \Amethyst\Repositories\InvoiceContainerRepository getRepository()
 * @method \Amethyst\Serializers\InvoiceContainerSerializer getSerializer()
 * @method \Amethyst\Validators\InvoiceContainerValidator getValidator()
 * @method \Amethyst\Authorizers\InvoiceContainerAuthorizer getAuthorizer()
 */
class InvoiceContainerManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.invoice.data.invoice-container';
}
