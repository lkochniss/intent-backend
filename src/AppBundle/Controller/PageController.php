<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Page;
use AppBundle\Form\Type\PageType;

/**
 * Class PageController
 */
class PageController extends AbstractCrudController
{
    /**
     * @return Page
     */
    protected function createNewEntity() : AbstractModel
    {
        return new Page();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return PageType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Page';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Page';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_page';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'page';
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
