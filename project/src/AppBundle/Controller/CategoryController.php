<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryType;

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
        return new CategoryType();
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

    public function showAction($id)
    {
        return $this->render(
            ':Category:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Category:delete.html.twig',
            array(// ...
            )
        );
    }
}
