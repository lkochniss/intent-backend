<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function createAction()
    {
        return $this->render('Event:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Event:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Event:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Event:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($type = null, $page)
    {
        return $this->render('Event:list.html.twig', array(
                // ...
            ));    }

}
