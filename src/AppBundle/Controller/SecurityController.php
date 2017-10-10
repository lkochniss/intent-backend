<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\PasswordResetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * Class SecurityController
 */
class SecurityController extends Controller
{
    /**
     * @return Response
     */
    public function loginAction() : Response
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render(
            ':Security:login.html.twig',
            array(
                'last_username' => $authenticationUtils->getLastUsername(),
                'error' => $authenticationUtils->getLastAuthenticationError(),
            )
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function resetPasswordAction(Request $request) : Response
    {
        $form = $this->createForm(new PasswordResetType());
        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $username = $form->getData()['username'];
                $repository = $this->getDoctrine()->getRepository('AppBundle:User');
                /**
                 * @var User $user
                 */
                $user = $repository->findOneBy(array('username' => $username));

                if (!is_null($user)) {
                    $generator = new SecureRandom();
                    $password = $generator->nextBytes(8);

                    $encoder = $this->container->get('security.password_encoder');
                    $encodedPassword = $encoder->encodePassword($user, $password);
                    $user->setPassword($encodedPassword);

                    $user->setValidUntil(new \DateTime('+2 hours'));

                    $repository->save($user);
                }

                return $this->redirectToRoute('intent_backend_login');
            }
        }

        return $this->render(
            ':Security:password.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
}
