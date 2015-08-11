<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublisherController extends Controller
{
    public function createAction()
    {
        return $this->render('Publisher:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Publisher:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Publisher:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Publisher:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($type = null, $page)
    {
        return $this->render('Publisher:list.html.twig', array(
                // ...
            ));    }

}
