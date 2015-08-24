<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractCrudController extends Controller
{
    const PAGING_LIMIT = 25;

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
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
                'entity' => $entity
            )
        );
    }

    /**
     * @param null $type
     * @param int $page
     * @return Response
     */
    public function listAction($type = null, $page = 1)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityName());

        $entities = $repository->findPaginated($page, self::PAGING_LIMIT);
        $totalPages = ceil(count($entities) / self::PAGING_LIMIT);

        return $this->render(
            sprintf('%s/list.html.twig', $this->getTemplateBasePath()),
            array(
                'entities' => $entities,
                'page' => $page,
                'totalPages' => $totalPages,
            )
        );
    }

    /**
     * @param $action
     * @param array $options
     * @return string
     */
    protected function generateUrlForAction($action, $options = array())
    {
        return $this->generateUrl(
            sprintf('%s_%s', $this->getRoutePrefix(), $action),
            $options
        );
    }

    /**
     * @param AbstractModel $entity
     */
    protected function handleValidForm(AbstractModel $entity)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityName());
        $repository->save($entity, $this->getUser());

        $this->addFlash('success', "Speichern erfolgreich");
    }

    /**
     * @return AbstractModel
     */
    abstract protected function createNewEntity();

    /**
     * @return AbstractType
     */
    abstract protected function getFormType();

    /**
     * @return string
     */
    abstract protected function getTemplateBasePath();

    /**
     * @return string
     */
    abstract protected function getEntityName();

    /**
     * @return string
     */
    abstract protected function getRoutePrefix();

    /**
     * @return string
     */
    abstract protected function getTranslationDomain();

    /**
     * @param AbstractModel $entity
     * @param $request
     * @return RedirectResponse|Response
     */
    private function createAndHandleForm(AbstractModel $entity, $request, $action, $options = array())
    {
        $form = $this->createForm(
            $this->getFormType(),
            $entity,
            array(
                'action' => $this->generateUrlForAction($action, $options),
                'method' => 'POST',
            )
        );

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->handleValidForm($entity);

                return $this->redirect($this->generateUrlForAction('edit', array('id' => $entity->getId())));
            }
        }

        return $this->render(
            sprintf('%s/edit.html.twig', $this->getTemplateBasePath()),
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }
}
