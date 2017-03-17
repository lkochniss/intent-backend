<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

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
    protected function createNewEntity()
    {
        return new Page();
    }

    /**
     * @return PageType
     */
    protected function getFormType()
    {
        return PageType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Page';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Page';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_page';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'page';
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
