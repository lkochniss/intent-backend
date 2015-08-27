<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractArticleController extends AbstractCrudController
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $this->denyAccessUnlessGranted(
            $this->getWriteAccessLevel(), null, $this->getAccessDeniedMessage());
        $entity = $this->createNewEntity();

        return $this->createAndHandleForm($entity, $request, 'create');
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted($this->getWriteAccessLevel(), null, $this->getAccessDeniedMessage());
        $entity = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        if (is_null($entity)) {
            throw new NotFoundHttpException(
                $this->get('translator')->trans(
                    $this->getTranslationDomain().'.not_found',
                    array(),
                    $this->getTranslationDomain()
                )
            );
        }

        return $this->createAndHandleForm($entity, $request, 'edit', array('id' => $entity->getId()));
    }

    /**
     * @param $id
     * @return Response
     */
    public function showAction($id)
    {
        $this->denyAccessUnlessGranted($this->getReadAccessLevel(), null, $this->getAccessDeniedMessage());
        $entity = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        if (is_null($entity)) {
            throw new NotFoundHttpException(
                $this->get('translator')->trans(
                    $this->getTranslationDomain().'.not_found',
                    array(),
                    $this->getTranslationDomain()
                )
            );
        }

        return $this->render(
            sprintf('%s/show.html.twig', $this->getTemplateBasePath()),
            array(
                'entity' => $entity,
            )
        );
    }

    /**
     * @return Response
     */
    public function listAction()
    {
        $this->denyAccessUnlessGranted($this->getReadAccessLevel(), null, $this->getAccessDeniedMessage());
        $entities = $this->getDoctrine()->getRepository($this->getEntityName())->findAll();

        return $this->render(
            sprintf('%s/list.html.twig', $this->getTemplateBasePath()),
            array(
                'entities' => $entities,
            )
        );
    }

    /**
     * @return String
     */
    abstract protected function getReadAccessLevel();

    /**
     * @return String
     */
    abstract protected function getWriteAccessLevel();

    /**
     * @return String
     */
    abstract protected function getPublishAccessLevel();

    /**
     * @return String
     */
    protected function getAccessDeniedMessage(){
        return $this->get('translator')->trans(
            $this->getTranslationDomain().'.access_denied',
            array(),
            $this->getTranslationDomain()
        );
    }
}
