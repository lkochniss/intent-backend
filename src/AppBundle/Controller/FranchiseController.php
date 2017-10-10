<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
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
    protected function createNewEntity() : AbstractModel
    {
        return new Franchise();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return FranchiseType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Franchise';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Franchise';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_franchise';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'franchise';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel() : string
    {
        return 'ROLE_READ_META';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel() : string
    {
        return 'ROLE_WRITE_META';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel() : string
    {
        return 'ROLE_PUBLISH_META';
    }
}
