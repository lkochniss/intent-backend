<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function createAction()
    {
        return $this->render('Article:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Article:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Article:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Article:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($type = null, $page)
    {
        return $this->render('Article:list.html.twig', array(
                // ...
            ));    }

}
