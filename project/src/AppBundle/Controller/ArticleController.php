<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    public function createAction(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $article = $form->getData();
            $this->getArticleRepository()->save($article);

            return $this->redirectToRoute(
                'intent_backend_article_edit',
                array(
                    'id' => $article->getId(),
                )
            );
        }

        return $this->render(
            ':Article:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id, Request $request)
    {
        $article = $this->getArticleRepository()->find($id);

        if (is_null($article)) {
            throw new NotFoundHttpException($this->get('translator')->trans('article.not_found', array(), 'article'));
        }

        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $article = $form->getData();
            $this->getArticleRepository()->save($article);

            return $this->redirectToRoute(
                'intent_backend_article_edit',
                array(
                    'id' => $article->getId(),
                )
            );
        }

        return $this->render(
            ':Article:edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function showAction($id)
    {
        return $this->render(
            ':Article:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Article:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $articles = $this->getArticleRepository()->findAll();

        return $this->render(
            ':Article:list.html.twig',
            array(
                'articles' => $articles,
            )
        );
    }

    private function getArticleRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Article');
    }
}
