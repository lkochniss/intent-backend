<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use AppBundle\Form\Type\TagType;

class TagController extends AbstractCrudController
{
    /**
     * @return Tag
     */
    protected function createNewEntity()
    {
        return new Tag();
    }

    /**
     * @return TagType
     */
    protected function getFormType()
    {
        return new TagType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Tag';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Tag';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_tag';
    }

    protected function getTranslationDomain()
    {
        return 'tag';
    }

    public function showAction($id)
    {
        return $this->render(
            ':Tag:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Tag:delete.html.twig',
            array(// ...
            )
        );
    }

}
