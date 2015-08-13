<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Form\Type\GameType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameController extends Controller
{
    public function createAction(Request $request)
    {
        $game = new Game();

        $form = $this->createForm(new GameType(), $game);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $game = $form->getData();
            $this->getGameRepository()->save($game);

            return $this->redirectToRoute(
                'intent_backend_game_edit',
                array(
                    'id' => $game->getId(),
                )
            );
        }

        return $this->render(
            ':Game:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id, Request $request)
    {
        $game = $this->getGameRepository()->find($id);

        if (is_null($game)) {
            throw new NotFoundHttpException($this->get('translator')->trans('game.not_found', array(), 'game'));
        }

        $form = $this->createForm(new GameType(), $game);

        if ($form->isValid()) {
            $game = $form->getData();
            $this->getGameRepository()->save($game);

            return $this->redirectToRoute(
                'intent_backend_game_edit',
                array(
                    'id' => $game->getId(),
                )
            );
        }

        return $this->render(
            ':Game:edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function showAction($id)
    {
        return $this->render(
            ':Game:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Game:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $games = $this->getGameRepository()->findAll();

        return $this->render(
            ':Game:list.html.twig',
            array(
                'games' => $games,
            )
        );
    }

    private function getGameRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Game');
    }

}
