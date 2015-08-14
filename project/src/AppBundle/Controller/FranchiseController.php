<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Franchise;
use AppBundle\Form\Type\FranchiseType;

class FranchiseController extends AbstractCrudController
{
    /**
     * @return Franchise
     */
    protected function createNewEntity()
    {
        return new Franchise();
    }

    /**
     * @return FranchiseType
     */
    protected function getFormType()
    {
        return new FranchiseType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Franchise';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Franchise';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_franchise';
    }

    protected function getTranslationDomain()
    {
        return 'franchise';
    }

    public function showAction($id)
    {
        return $this->render(
            ':Franchise:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Franchise:delete.html.twig',
            array(// ...
            )
        );
    }

}
