<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
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
    protected function createNewEntity() : AbstractModel
    {
        return new Article();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return ArticleType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Article';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Article';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_article';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'article';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel() : string
    {
        return 'ROLE_READ_ARTICLE';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel() : string
    {
        return 'ROLE_WRITE_ARTICLE';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel() : string
    {
        return 'ROLE_PUBLISH_ARTICLE';
    }
}
