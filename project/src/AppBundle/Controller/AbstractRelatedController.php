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
        $resultList = new ArrayCollection();
        $franchises = null;
        $games = null;

        $type = $entity->getType();
        $resultList = $this->getArticlesByRelated($entity, $resultList);

        if ($type == 'publisher') {
            $franchises = $entity->getFranchises();
        } elseif ($type == 'franchise') {
            $games = $entity->getGames();
        } elseif ($type == 'studio') {
            $franchises = $entity->getFranchises();
            $games = $entity->getGames();
        }

        if (!is_null($franchises)){
            foreach ($franchises as $franchise) {
                $resultList = $this->getArticlesByRelated($franchise, $resultList);
                foreach ($franchise->getGames() as $game) {
                    $resultList = $this->getArticlesByRelated($game, $resultList);
                }
            }
        }

        if(!is_null($games)){
            foreach ($games as $game) {
                $resultList = $this->getArticlesByRelated($game, $resultList);
            }
        }

        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findBy(array(),array('priority' => 'ASC'));

        $articlesInCategory = array();
        foreach ( $categories as $category ) {
            $result = new ArrayCollection();
            foreach ($resultList as $article) {
                if ($article->getCategory() == $category){
                    $result->add($article);
                }
            }
            if ($result->count() > 0){
                $articlesInCategory[$category->getName()] = $result->toArray();
            }
        }

        return $articlesInCategory;
    }

    /**
     * @param $related
     * @param ArrayCollection $resultList
     * @return ArrayCollection
     */
    private function getArticlesByRelated($related, ArrayCollection $resultList)
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();
        foreach ($articles as $article) {
            if ($article->getRelated() == $related) {
                $resultList->add($article);
            }
        }
        return $resultList;
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
