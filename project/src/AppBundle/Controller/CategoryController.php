<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function createAction()
    {
        return $this->render('Category:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Category:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Category:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Category:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($page)
    {
        return $this->render('Category:list.html.twig', array(
                // ...
            ));    }

}
