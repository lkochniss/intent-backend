<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function createAction()
    {
        return $this->render('Page:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Page:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Page:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Page:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($type = null, $page)
    {
        return $this->render('Page:list.html.twig', array(
                // ...
            ));    }

}
