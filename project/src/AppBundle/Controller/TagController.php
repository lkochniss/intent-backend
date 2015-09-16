<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use AppBundle\Form\Type\TagType;

/**
 * Class TagController
 */
class TagController extends AbstractMetaController
{
    /**
     * @return Tag
     */
    protected function createNewEntity()
    {
        return new Tag();
    }

    /**
     * @return TagType
     */
    protected function getFormType()
    {
        return new TagType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Tag';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Tag';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_tag';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'tag';
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
