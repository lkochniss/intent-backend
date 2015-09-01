<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Profile;
use AppBundle\Form\Type\ProfileType;

class ProfileController extends AbstractCrudController
{
    /**
     * @return Profile
     */
    protected function createNewEntity()
    {
        return new Profile();
    }

    /**
     * @return ProfileType
     */
    protected function getFormType()
    {
        return new ProfileType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Profile';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Profile';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_profile';
    }

    protected function getTranslationDomain()
    {
        return 'profile';
    }

    /**
     * @param AbstractModel $entity
     */
    protected function handleValidForm(AbstractModel $entity)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityName());

        $entity->setUser($this->getUser());

        $repository->save($entity);

        $this->addFlash('success', "Speichern erfolgreich");
    }
}
