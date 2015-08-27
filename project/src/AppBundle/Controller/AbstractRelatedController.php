<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Related;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractRelatedController extends AbstractMetaController
{
    /**
     * @param $id
     * @return Response
     */
    public function showAction($id)
    {
        $this->denyAccessUnlessGranted($this->getReadAccessLevel(), null, $this->getAccessDeniedMessage());
        $entity = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        $categories = $this->loopRelated($entity);


        if (is_null($entity)) {
            throw new NotFoundHttpException(
                $this->get('translator')->trans(
                    $this->getTranslationDomain().'.not_found',
                    array(),
                    $this->getTranslationDomain()
                )
            );
        }

        return $this->render(
            sprintf('%s/show.html.twig', $this->getTemplateBasePath()),
            array(
                'entity' => $entity,
                'categories' => $categories,
            )
        );
    }

    /**
     * @param Related $entity
     * @return array
     */
    private function loopRelated(Related $entity)
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
    private function getArticlesByRelated(Related $related, ArrayCollection $resultList)
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();
        foreach ($articles as $article) {
            if ($article->getRelated() == $related) {
                $resultList->add($article);
            }
        }
        return $resultList;
    }
}
