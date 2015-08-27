<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use AppBundle\Form\Type\TagType;

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

    protected function getTranslationDomain()
    {
        return 'tag';
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
