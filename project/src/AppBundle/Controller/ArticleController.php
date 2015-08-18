<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticleType;

class ArticleController extends AbstractCrudController
{
    /**
     * @return Article
     */
    protected function createNewEntity()
    {
        return new Article();
    }

    /**
     * @return ArticleType
     */
    protected function getFormType()
    {
        return new ArticleType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Article';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Article';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_article';
    }

    protected function getTranslationDomain()
    {
        return 'article';
    }

    public function showAction($id)
    {
        return $this->render(
            ':Article:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Article:delete.html.twig',
            array(// ...
            )
        );
    }
}
