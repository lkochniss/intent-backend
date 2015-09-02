<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryPublishType;
use AppBundle\Form\Type\CategoryType;

class CategoryController extends AbstractMetaController
{
    /**
     * @return Category
     */
    protected function createNewEntity()
    {
        return new Category();
    }

    /**
     * @return CategoryType
     */
    protected function getFormType()
    {
        return new CategoryType();
    }

    /**
     * @return CategoryPublishType
     */
    protected function getPublishType()
    {
        return new CategoryPublishType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Category';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Category';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_category';
    }

    protected function getTranslationDomain()
    {
        return 'category';
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
