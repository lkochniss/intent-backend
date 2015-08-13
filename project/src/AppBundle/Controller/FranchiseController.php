<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Franchise;
use AppBundle\Form\Type\FranchiseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FranchiseController extends Controller
{
    public function createAction(Request $request)
    {
        $franchise = new Franchise();

        $form = $this->createForm(new FranchiseType(), $franchise);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $franchise = $form->getData();
            $this->getFranchiseRepository()->save($franchise);

            return $this->redirectToRoute(
                'intent_backend_franchise_edit',
                array(
                    'id' => $franchise->getId(),
                )
            );
        }

        return $this->render(
            ':Franchise:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id, Request $request)
    {
        $franchise = $this->getFranchiseRepository()->find($id);

        if (is_null($franchise)) {
            throw new NotFoundHttpException($this->get('translator')->trans('franchise.not_found', array(), 'franchise'));
        }

        $form = $this->createForm(new FranchiseType(), $franchise);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $franchise = $form->getData();
            $this->getFranchiseRepository()->save($franchise);

            return $this->redirectToRoute(
                'intent_backend_franchise_edit',
                array(
                    'id' => $franchise->getId(),
                )
            );
        }

        return $this->render(
            ':Franchise:edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function showAction($id)
    {
        return $this->render(
            ':Franchise:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Franchise:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $franchises = $this->getFranchiseRepository()->findAll();

        return $this->render(
            ':Franchise:list.html.twig',
            array(
                'franchises' => $franchises,
            )
        );
    }

    private function getFranchiseRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Franchise');
    }

}
