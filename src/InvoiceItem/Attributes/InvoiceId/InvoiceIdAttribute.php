<?php

namespace Railken\LaraOre\InvoiceItem\Attributes\InvoiceId;

use Railken\Laravel\Manager\Attributes\BelongsToAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class InvoiceIdAttribute extends BelongsToAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'invoice_id';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = false;

    /**
     * Is the attribute unique.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * List of all exceptions used in validation.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_DEFINED    => Exceptions\InvoiceItemInvoiceIdNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\InvoiceItemInvoiceIdNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceItemInvoiceIdNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\InvoiceItemInvoiceIdNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'invoiceitem.attributes.invoice_id.fill',
        Tokens::PERMISSION_SHOW => 'invoiceitem.attributes.invoice_id.show',
    ];

    /**
     * Retrieve the name of the relation.
     *
     * @return string
     */
    public function getRelationName()
    {
        return 'invoice';
    }

    /**
     * Retrieve eloquent relation.
     *
     * @param EntityContract $entity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRelationBuilder(EntityContract $entity)
    {
        return $entity->invoice();
    }

    /**
     * Retrieve relation manager.
     *
     * @param EntityContract $entity
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getRelationManager(EntityContract $entity)
    {
        return new \Railken\LaraOre\Invoice\InvoiceManager($this->getManager()->getAgent());
    }
}
