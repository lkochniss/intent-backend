<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TagController extends Controller
{
    public function createAction()
    {
        return $this->render('Tag:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Tag:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Tag:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Tag:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($type = null, $page)
    {
        return $this->render('Tag:list.html.twig', array(
                // ...
            ));    }

}
