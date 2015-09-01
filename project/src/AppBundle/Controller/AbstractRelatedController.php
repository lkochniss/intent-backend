<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractRelatedController extends AbstractMetaController
{
    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function showAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted($this->getReadAccessLevel(), null, $this->getAccessDeniedMessage());
        $entity = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        return $this->createAndHandlePublishForm($entity, $request, 'show', array('id' => $entity->getId()));
    }

    /**
     * @param $entity
     * @return array
     */
    private function loopRelated($entity)
    {
        $franchises = null;
        $games = null;

        $resultList = $related = $this->getRelatedArticles($entity);

        if ($entity->getType() == 'publisher') {
            $franchises = $entity->getFranchises();
        } elseif ($entity->getType() == 'franchise') {
            $games = $entity->getGames();
        } elseif ($entity->getType() == 'studio') {
            $franchises = $entity->getFranchises();
            $games = $entity->getGames();
        }

        if (!is_null($franchises)) {
            foreach ($franchises as $franchise) {
                $resultList = array_merge($resultList, $this->getRelatedArticles($franchise));

                foreach ($franchise->getGames() as $game) {
                    $resultList = array_merge($resultList, $this->getRelatedArticles($game));
                }
            }
        }

        if (!is_null($games)) {
            foreach ($games as $game) {
                $resultList = array_merge($resultList, $this->getRelatedArticles($game));
            }
        }

        return $this->mapArticlesToCategories($resultList);
    }

    /**
     * @param $entity
     * @return \AppBundle\Entity\Article[]|array
     */
    private function getRelatedArticles($entity)
    {
        return $related = $this->getDoctrine()->getRepository('AppBundle:Article')->findBy(
            array('related' => $entity),
            array('publishAt' => 'DESC')
        );
    }

    /**
     * @param $articles
     * @return array
     */
    private function mapArticlesToCategories($articles)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findBy(
            array(),
            array('priority' => 'ASC')
        );

        $articlesInCategory = array();
        foreach ($categories as $category) {
            $result = new ArrayCollection();
            foreach ($articles as $article) {
                if ($article->getCategory() == $category) {
                    $result->add($article);
                }
                if ($result->count() == 5) {
                    break;
                }
            }
            if ($result->count() > 0) {
                $articlesInCategory[$category->getName()] = $result->toArray();
            }
        }

        return $articlesInCategory;
    }

    /**
     * @param AbstractModel $entity
     * @param $request
     * @return RedirectResponse|Response
     */
    protected function createAndHandlePublishForm(AbstractModel $entity, $request, $action, $options = array())
    {
        $form = $this->createForm(
            $this->getPublishType(),
            $entity,
            array(
                'action' => $this->generateUrlForAction($action, $options),
                'method' => 'POST',
            )
        );

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->handleValidForm($entity);
                $entity->setPublished(true);

                return $this->redirect($this->generateUrlForAction('edit', array('id' => $entity->getId())));
            }
        }

        $categories = $this->loopRelated($entity);

        return $this->render(
            sprintf('%s/show.html.twig', $this->getTemplateBasePath()),
            array(
                'entity' => $entity,
                'categories' => $categories,
                'form' => $form->createView(),
            )
        );
    }
}
