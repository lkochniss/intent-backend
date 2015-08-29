<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Franchise;
use AppBundle\Form\Type\FranchisePublishType;
use AppBundle\Form\Type\FranchiseType;

class FranchiseController extends AbstractRelatedController
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
     * @return FranchisePublishType
     */
    protected function getPublishType()
    {
        return new FranchisePublishType();
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

    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_META';
    }

    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_META';
    }

    protected function getPublishAccessLevel()
    {
        return 'ROLE_PUBLISH_META';
    }

}
