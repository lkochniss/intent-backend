<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Invite;
use AppBundle\Entity\User;
use AppBundle\Form\Type\InviteType;
use AppBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Util\SecureRandom;

class UserController extends AbstractCrudController
{

    public function inviteAction(Request $request)
    {
        $invite = new Invite();
        $form = $this->createForm(
            new InviteType(),
            $invite
        );

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $invite = $form->getData();

                $generator = new SecureRandom();
                $random = $generator->nextBytes(15);
                $invite->setToken(md5($random));

                $this->getDoctrine()->getRepository('AppBundle:Invite')->save($invite, $this->getUser());

                $translator = $this->get('translator');

                $mailer = $this->get('mailer');

                $message = $mailer->createMessage()
                    ->setSubject($translator->trans('invite.mail.subject', array(), 'invite'))
                    ->setFrom($translator->trans('invite.mail.from', array(), 'invite'))
                    ->setTo($invite->getEmail())
                    ->setBody(
                        $this->renderView(
                            'User/mail.html.twig',
                            array(
                                'invite' => $invite,
                            )
                        ),
                        'text/html'
                    );

                $mailer->send($message);

                return $this->redirectToRoute(
                    'intent_backend_user_list'
                );
            }
        }

        return $this->render(
            'User/invite.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function tokenAction($token, Request $request)
    {

    }

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
        $encodedPassword = $encoder->encodePassword($entity, $plainPassword);

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
