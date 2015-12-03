<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Related;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractRelatedController
 */
abstract class AbstractRelatedController extends AbstractMetaController
{
    /**
     * @param integer $id      Id of entity.
     * @param Request $request HTTP Request.
     * @return RedirectResponse|Response
     */
    public function showAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted($this->getReadAccessLevel(), null, $this->getAccessDeniedMessage());
        $entity = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        return $this->createAndHandlePublishForm($entity, $request, 'show', array('id' => $entity->getId()));
    }

    /**
     * @param Related $entity Related entity.
     * @return array
     */
    private function loopRelated(Related $entity)
    {
        $franchises = null;
        $games = null;
        $expansions = null;

        $resultList = $this->getRelatedArticles($entity);

        if ($entity->getType() == 'publisher') {
            $franchises = $entity->getFranchises();
        } elseif ($entity->getType() == 'franchise') {
            $games = $entity->getGames();
        } elseif ($entity->getType() == 'studio') {
            $franchises = $entity->getFranchises();
            $games = $entity->getGames();
        } elseif ($entity->getType() == 'game') {
            $expansions = $entity->getExpansions();
        }

        if (!is_null($franchises)) {
            foreach ($franchises as $franchise) {
                $resultList = array_merge($resultList, $this->getRelatedArticles($franchise));

                if (!is_null($franchise->getGames())) {
                    if (!is_null($games)) {
                        $games = array_merge($games, $franchise->getGames());
                    } else {
                        $games = $franchise->getGames();
                    }
                }
            }
        }

        if (!is_null($games)) {
            foreach ($games as $game) {
                $resultList = array_merge($resultList, $this->getRelatedArticles($game));

                if (!is_null($game->getExpansions())) {
                    if (!is_null($expansions)) {
                        $expansions = array_merge($expansions, $game->getExpansions());
                    } else {
                        $expansions = $game->getExpansions();
                    }
                }
            }
        }

        if (!is_null($expansions)) {
            foreach ($expansions as $expansion) {
                $resultList = array_merge($resultList, $this->getRelatedArticles($expansion));
            }
        }

        return $this->mapArticlesToCategories($resultList);
    }

    /**
     * @param Related $entity Related entity.
     * @return \AppBundle\Entity\Article[]|array
     */
    private function getRelatedArticles(Related $entity)
    {
        return $related = $this->getDoctrine()->getRepository('AppBundle:Article')->findBy(
            array('related' => $entity),
            array('publishAt' => 'DESC')
        );
    }

    /**
     * @param array $articles Array of articles.
     * @return array
     */
    private function mapArticlesToCategories(array $articles)
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
     * @param AbstractModel $entity  Abstract entity.
     * @param Request       $request HTTP Request.
     * @param string        $action  Type of action.
     * @param array         $options Array of options.
     * @return RedirectResponse|Response
     */
    protected function createAndHandlePublishForm(
        AbstractModel $entity,
        Request $request,
        $action,
        array $options = array()
    ) {
        $categories = $this->loopRelated($entity);

        return $this->render(
            sprintf('%s/show.html.twig', $this->getTemplateBasePath()),
            array(
                'entity' => $entity,
                'categories' => $categories,
            )
        );
    }
}
