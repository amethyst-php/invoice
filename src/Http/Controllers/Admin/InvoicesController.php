<?php

namespace Railken\Amethyst\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Railken\Amethyst\Api\Http\Controllers\RestManagerController;
use Railken\Amethyst\Api\Http\Controllers\Traits as RestTraits;
use Railken\Amethyst\Managers\InvoiceManager;

class InvoicesController extends RestManagerController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestRemoveTrait;

    /**
     * The class of the manager.
     *
     * @var string
     */
    public $class = InvoiceManager::class;

    /**
     * @param string $key
     *
     * @return string
     */
    public function parseKey($key)
    {
        if ($key === 'number') {
            return $this->getManager()->getNumberManager()->parseKey();
        }

        return parent::parseKey($key);
    }

    /**
     * Issue a resource.
     *
     * @param mixed                    $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function issue($id, Request $request)
    {
        $resource = $this->getManager()->getRepository()->findOneById($id);

        if (!$resource) {
            return $this->not_found();
        }

        $result = $this->getManager()->issue($resource);

        if ($result->ok()) {
            return $this->success([
                'data' => $this->getManager()->getSerializer()->serialize($result->getResource(), $this->keys->selectable)->all(),
            ]);
        }

        return $this->error([
            'errors' => $result->getSimpleErrors(),
        ]);
    }
}
