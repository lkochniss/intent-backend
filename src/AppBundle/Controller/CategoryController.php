<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryType;

/**
 * Class CategoryController
 */
class CategoryController extends AbstractCrudController
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
        return CategoryType::class;
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

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'category';
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
