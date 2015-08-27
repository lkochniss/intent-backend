<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use AppBundle\Form\Type\PageType;

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
        return new PageType();
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

    protected function getTranslationDomain()
    {
        return 'page';
    }

    protected function getReadAccessLevel()
    {
        return 'ROLE_ADMIN';
    }

    protected function getWriteAccessLevel()
    {
        return 'ROLE_ADMIN';
    }

    protected function getPublishAccessLevel()
    {
        return 'ROLE_ADMIN';
    }
}
