<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Publisher;
use AppBundle\Form\Type\PublisherType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PublisherController extends Controller
{
    public function createAction(Request $request)
    {
        $publisher = new Publisher();

        $form = $this->createForm(new PublisherType(), $publisher);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $publisher = $form->getData();
            $this->getPublisherRepository()->save($publisher);

            return $this->redirectToRoute(
                'intent_backend_publisher_edit',
                array(
                    'id' => $publisher->getId(),
                )
            );
        }

        return $this->render(
            ':Publisher:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id, Request $request)
    {
        $page = $this->getPublisherRepository()->find($id);

        if (is_null($page)) {
            throw new NotFoundHttpException($this->get('translator')->trans('publisher.not_found', array(), 'publisher'));
        }

        $form = $this->createForm(new PublisherType(), $page);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $publisher = $form->getData();
            $this->getPublisherRepository()->save($publisher);

            return $this->redirectToRoute(
                'intent_backend_publisher_edit',
                array(
                    'id' => $publisher->getId(),
                )
            );
        }

        return $this->render(
            ':Publisher:edit.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function showAction($id)
    {
        return $this->render(
            ':Publisher:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Publisher:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $publishers = $this->getPublisherRepository()->findAll();

        return $this->render(
            ':Publisher:list.html.twig',
            array(
                'publishers' => $publishers,
            )
        );
    }

    private function getPublisherRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Publisher');
    }

}
