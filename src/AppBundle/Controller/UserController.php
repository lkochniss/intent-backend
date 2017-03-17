<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;
use AppBundle\Form\Type\UserDeleteType;
use AppBundle\Form\Type\UserPasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class UserController
 */
class UserController extends AbstractCrudController
{
    /**
     * @param Request $request HTTP Request.
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
        $form = $this->createForm(UserType::class, $user);

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
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
     * @param integer $id      The user id.
     * @param Request $request HTTP Request.
     * @throws NotFoundHttpException Throws error if user not found.
     * @return RedirectResponse|Response
     */
    public function deleteAction($id, Request $request)
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

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if (is_null($user)) {
            throw new NotFoundHttpException(
                $this->get('translator')->trans(
                    'user.access_denied',
                    array(),
                    'user'
                )
            );
        }

        $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');
        $users = $userRepository->findAllUsersBut($user);

        $form = $this->createForm(UserDeleteType::class, null, array('users' => $users));

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');

                if (!is_null($data['user'])) {
                    $newUser = $data['user'];

                    foreach ($user->getArticles() as $article) {
                        $article->setCreatedBy($newUser);
                        $articleRepository->save($article, $newUser);

                        $newUser->addArticle($article);
                        $user->removeArticle($article);
                    }
                    $userRepository->save($newUser);
                }

                $userRepository->delete($user);

                return $this->redirectToRoute('intent_backend_user_list');
            }
        }


        return $this->render(
            'User/delete.html.twig',
            array(
                'form' => $form->createView(),
                'user' => $user
            )
        );
    }

    /**
     * @param integer $id      UserID.
     * @param Request $request HTTP Request.
     * @return RedirectResponse|Response
     */
    public function passwordAction($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        if ($this->get('security.token_storage')->getToken()->getUser() != $user) {
            throw new AccessDeniedException($this->getAccessDeniedMessage());
        }

        $form = $this->createForm(UserPasswordType::class, $user);

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
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
        return UserType::class;
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

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'user';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel()
    {
        return 'ROLE_ADMIN';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel()
    {
        return 'ROLE_ADMIN';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel()
    {
        return 'ROLE_ADMIN';
    }
}
