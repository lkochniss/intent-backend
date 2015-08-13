<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Form\Type\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function createAction(Request $request)
    {
        $event = new Event();

        $form = $this->createForm(new EventType(), $event);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = $form->getData();
            $this->getEventRepository()->save($event);

            return $this->redirectToRoute(
                'intent_backend_event_edit',
                array(
                    'id' => $event->getId(),
                )
            );
        }

        return $this->render(
            ':Event:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id)
    {
        $event = $this->getEventRepository()->find($id);

        if (is_null($event)) {
            throw new NotFoundHttpException($this->get('translator')->trans('event.not_found', array(), 'event'));
        }

        $form = $this->createForm(new EventType(), $event);

        if ($form->isValid()) {
            $franchise = $form->getData();
            $this->getEventRepository()->save($franchise);

            return $this->redirectToRoute(
                'intent_backend_event_edit',
                array(
                    'id' => $franchise->getId(),
                )
            );
        }

        return $this->render(
            ':Event:edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function showAction($id)
    {
        return $this->render(
            ':Event:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Event:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $events = $this->getEventRepository()->findAll();

        return $this->render(
            ':Event:list.html.twig',
            array(
                'events' => $events,
            )
        );
    }

    private function getEventRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Event');
    }
}
