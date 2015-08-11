<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FranchiseController extends Controller
{
    public function createAction()
    {
        return $this->render('Franchise:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Franchise:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Franchise:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Franchise:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($type = null, $page)
    {
        return $this->render('Franchise:list.html.twig', array(
                // ...
            ));    }

}
