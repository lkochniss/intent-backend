<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserPasswordType;
use AppBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Util\SecureRandom;

class UserController extends AbstractCrudController
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $this->denyAccessUnlessGranted(
            'ROLE_ADMIN',
            null,
            $this->get('translator')->trans(
                'user.access_denied',
                array(),
                'user'
            )
        );

        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $generator = new SecureRandom();
                $password = md5(uniqid(rand(), true));

                $encoder = $this->container->get('security.password_encoder');
                $encodedPassword = $encoder->encodePassword($user, $password);
                $user->setPassword($encodedPassword);

                $user->setValidUntil(new \DateTime('+1 day'));

                $this->getDoctrine()->getRepository('AppBundle:User')->save($user);

                $translator = $this->get('translator');

                $mailer = $this->get('mailer');

                $message = $mailer->createMessage()
                    ->setSubject($translator->trans('user.mail.subject', array(), 'user'))
                    ->setFrom($translator->trans('user.mail.from', array(), 'user'))
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView(
                            'Mail/new_user.html.twig',
                            array(
                                'user' => $user,
                                'password' => $password,
                            )
                        ),
                        'text/html'
                    );

                $mailer->send($message);

                return $this->redirectToRoute('intent_backend_user_list');
            }
        }

        return $this->render(
            'User/edit.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function passwordAction($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        $form = $this->createForm(new UserPasswordType(), $user);

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $encoder = $this->container->get('security.password_encoder');
                $encodedPassword = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($encodedPassword);

                $user->setValidUntil(null);

                $this->getDoctrine()->getRepository('AppBundle:User')->save($user);

                return $this->redirectToRoute('intent_backend_dashboard');
            }
        }

        return $this->render(
            'User/password.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
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
}
