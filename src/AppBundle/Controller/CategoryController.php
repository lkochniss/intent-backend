<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
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
    protected function createNewEntity() : AbstractModel
    {
        return new Category();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return CategoryType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Category';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Category';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_category';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'category';
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
