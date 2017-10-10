<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Tag;
use AppBundle\Form\Type\TagType;

/**
 * Class TagController
 */
class TagController extends AbstractCrudController
{
    /**
     * @return Tag
     */
    protected function createNewEntity() : AbstractModel
    {
        return new Tag();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return TagType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Tag';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Tag';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_tag';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'tag';
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
