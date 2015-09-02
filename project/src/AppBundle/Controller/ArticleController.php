<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticlePublishType;
use AppBundle\Form\Type\ArticleType;

class ArticleController extends AbstractArticleController
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
     * @return ArticlePublishType
     */
    protected function getPublishType()
    {
        return new ArticlePublishType();
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

    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_ARTICLE';
    }

    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_ARTICLE';
    }

    protected function getPublishAccessLevel()
    {
        return 'ROLE_PUBLISH_ARTICLE';
    }
}
