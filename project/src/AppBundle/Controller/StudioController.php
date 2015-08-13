<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Studio;
use AppBundle\Form\Type\StudioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StudioController extends Controller
{
    public function createAction(Request $request)
    {
        $studio = new Studio();

        $form = $this->createForm(new StudioType(), $studio);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $studio = $form->getData();
            $this->getStudioRepository()->save($studio);

            return $this->redirectToRoute(
                'intent_backend_studio_edit',
                array(
                    'id' => $studio->getId(),
                )
            );
        }

        return $this->render(
            ':Studio:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id, Request $request)
    {
        $studio = $this->getStudioRepository()->find($id);

        if (is_null($studio)) {
            throw new NotFoundHttpException($this->get('translator')->trans('$studio.not_found', array(), '$studio'));
        }

        $form = $this->createForm(new StudioType(), $studio);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $studio = $form->getData();
            $this->getStudioRepository()->save($studio);

            return $this->redirectToRoute(
                'intent_backend_studio_edit',
                array(
                    'id' => $studio->getId(),
                )
            );
        }

        return $this->render(
            ':Studio:edit.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function showAction($id)
    {
        return $this->render(
            ':Studio:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Studio:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $studio = $this->getStudioRepository()->findAll();

        return $this->render(
            ':Studio:list.html.twig',
            array(
                'studios' => $studio,
            )
        );
    }

    private function getStudioRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Studio');
    }

}
