<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    public function createAction()
    {
        return $this->render('Game:create.html.twig', array(
                // ...
            ));    }

    public function editAction($id)
    {
        return $this->render('Game:edit.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        return $this->render('Game:show.html.twig', array(
                // ...
            ));    }

    public function deleteAction($id)
    {
        return $this->render('Game:delete.html.twig', array(
                // ...
            ));    }

    public function listAction($type = null, $page)
    {
        return $this->render('Game:list.html.twig', array(
                // ...
            ));    }

}
