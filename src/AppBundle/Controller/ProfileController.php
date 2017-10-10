<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Profile;
use AppBundle\Form\Type\ProfileType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class ProfileController
 */
class ProfileController extends AbstractCrudController
{
    /**
     * @param integer $id
     * @param Request $request
     * @throws NotFoundHttpException
     * @return RedirectResponse|Response
     */
    public function editAction($id, Request $request) : Response
    {
        $entity = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        if (is_null($entity)) {
            throw new NotFoundHttpException(
                $this->get('translator')->trans(
                    $this->getTranslationDomain() . '.not_found',
                    array(),
                    $this->getTranslationDomain()
                )
            );
        }

        if ($this->get('security.token_storage')->getToken()->getUser() != $entity->getUser()) {
            throw new AccessDeniedException($this->getAccessDeniedMessage());
        }

        return $this->createAndHandleForm($entity, $request, 'edit', array('id' => $entity->getId()));
    }

    /**
     * @return Profile
     */
    protected function createNewEntity() : AbstractModel
    {
        return new Profile();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return ProfileType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Profile';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Profile';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_profile';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'profile';
    }

    /**
     * @param AbstractModel $entity
     * @return null
     */
    protected function handleValidForm(AbstractModel $entity)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityName());

        $entity->setUser($this->getUser());

        $repository->save($entity);

        $this->addFlash('success', 'Speichern erfolgreich');

        return null;
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel() : string
    {
        return 'ROLE_USER';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel() : string
    {
        return 'ROLE_USER';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel() : string
    {
        return 'ROLE_USER';
    }
}
