<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticleType;

/**
 * Class ArticleController
 */
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
        return ArticleType::class;
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

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'article';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_ARTICLE';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_ARTICLE';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel()
    {
        return 'ROLE_PUBLISH_ARTICLE';
    }
}
