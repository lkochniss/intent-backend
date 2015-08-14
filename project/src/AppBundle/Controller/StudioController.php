<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Studio;
use AppBundle\Form\Type\StudioType;

class StudioController extends AbstractCrudController
{
    /**
     * @return Studio
     */
    protected function createNewEntity()
    {
        return new Studio();
    }

    /**
     * @return StudioType
     */
    protected function getFormType()
    {
        return new StudioType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Studio';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Studio';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_studio';
    }

    protected function getTranslationDomain()
    {
        return 'studio';
    }

    public function showAction($id)
    {
        return $this->render(
            ':Studio:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Studio:delete.html.twig',
            array(// ...
            )
        );
    }

}
