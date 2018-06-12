<?php

namespace Railken\LaraOre\InvoiceItem\Attributes\UnitId;

use Railken\Laravel\Manager\Attributes\BelongsToAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;
use Railken\Laravel\Manager\Contracts\ParameterBagContract;
use Illuminate\Support\Collection;

class UnitIdAttribute extends BelongsToAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'unit_id';

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
        Tokens::NOT_DEFINED    => Exceptions\InvoiceItemUnitIdNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\InvoiceItemUnitIdNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\InvoiceItemUnitIdNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\InvoiceItemUnitIdNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'invoiceitem.attributes.unit_id.fill',
        Tokens::PERMISSION_SHOW => 'invoiceitem.attributes.unit_id.show',
    ];

    /**
     * Retrieve the name of the relation.
     *
     * @return string
     */
    public function getRelationName()
    {
        return 'unit';
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
        return $entity->unit();
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
        return new \Railken\LaraOre\Taxonomy\TaxonomyManager($this->getManager()->getAgent());
    }

    /**
     * Is a value valid ?
     *
     * @param EntityContract $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return parent::valid($entity, $value) && $value->vocabulary->id === $this->getManager()->getTaxonomyItemVocabulary()->id;
    }


    /**
     * Update entity value.
     *
     * @param EntityContract       $entity
     * @param ParameterBagContract $parameters
     *
     * @return Collection
     */
    public function update(EntityContract $entity, ParameterBagContract $parameters)
    {
        // "unit_value" may be sent.
        $errors = new Collection();

        if ($parameters->exists('unit_name') && !$parameters->exists('unit_id') && !$parameters->exists('unit')) {
            $m = $this->getRelationManager($entity);


            $result = $m->findOrCreate([
                'vocabulary_id' => $this->getManager()->getTaxonomyItemVocabulary()->id,
                'name'          => $parameters->get('unit_name'),
            ]);

            if (!$result->ok()) {
                $errors->merge($result->getErrors());
            } else {
                $parameters->set('unit', $result->getResource());
            }
        }

        return $errors->merge(parent::update($entity, $parameters));
    }
}
