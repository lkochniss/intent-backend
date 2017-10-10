<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Expansion;
use AppBundle\Form\Type\ExpansionType;

/**
 * Class ExpansionController
 */
class ExpansionController extends AbstractCrudController
{
    /**
     * @return Expansion
     */
    protected function createNewEntity() : AbstractModel
    {
        return new Expansion();
    }

    /**
     * @return string
     */
    protected function getFormType()  : string
    {
        return ExpansionType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Expansion';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Expansion';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_expansion';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'expansion';
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
