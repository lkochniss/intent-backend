<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudioController extends Controller
{
    public function createAction()
    {
        return $this->render('Studio:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Studio:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Studio:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Studio:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($type = null, $page)
    {
        return $this->render('Studio:list.html.twig', array(
                // ...
            ));    }

}
