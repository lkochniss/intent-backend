<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;

class UserController extends AbstractCrudController
{
    /**
     * @return User
     */
    protected function createNewEntity()
    {
        return new User();
    }

    /**
     * @return UserType
     */
    protected function getFormType()
    {
        return new UserType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'User';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\User';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_user';
    }

    protected function getTranslationDomain()
    {
        return 'user';
    }

    /**
     * @param AbstractModel $entity
     */
    protected function handleValidForm(AbstractModel $entity)
    {
        $plainPassword = $entity->getPassword();

        $encoder = $this->container->get('security.password_encoder');
        $encodedPassword = $encoder->encodePassword($entity,$plainPassword);

        $entity->setPassword($encodedPassword);

        $repository = $this->getDoctrine()->getRepository($this->getEntityName());
        $repository->save($entity, $this->getUser());

        $this->addFlash('success', "Speichern erfolgreich");
    }

    public function showAction($id)
    {
        return $this->render(
            ':User:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':User:delete.html.twig',
            array(// ...
            )
        );
    }

}
