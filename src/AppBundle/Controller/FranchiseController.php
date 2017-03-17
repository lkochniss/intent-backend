<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Franchise;
use AppBundle\Form\Type\FranchiseType;

/**
 * Class FranchiseController
 */
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
        return FranchiseType::class;
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

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'franchise';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_META';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_META';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel()
    {
        return 'ROLE_PUBLISH_META';
    }
}
