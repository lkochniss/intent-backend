<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Profile;
use AppBundle\Form\Type\ProfileType;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class ProfileController
 */
class ProfileController extends AbstractCrudController
{
    /**
     * @param integer $id      Id of entity.
     * @param Request $request HTTP Request.
     * @throws NotFoundHttpException Throw exception if entity not found.
     * @return RedirectResponse|Response
     */
    public function editAction($id, Request $request)
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
    protected function createNewEntity()
    {
        return new Profile();
    }

    /**
     * @return ProfileType
     */
    protected function getFormType()
    {
        return ProfileType::class;
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

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'profile';
    }

    /**
     * @param AbstractModel $entity Abstract model of entity.
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
    protected function getReadAccessLevel()
    {
        return 'ROLE_USER';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel()
    {
        return 'ROLE_USER';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel()
    {
        return 'ROLE_USER';
    }
}
