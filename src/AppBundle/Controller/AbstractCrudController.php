<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Franchise;
use AppBundle\Entity\Game;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Related;
use AppBundle\Entity\Studio;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AbstractCrudController
 */
abstract class AbstractCrudController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request) : Response
    {
        $this->denyAccessUnlessGranted(
            $this->getWriteAccessLevel(),
            null,
            $this->getAccessDeniedMessage()
        );

        $entity = $this->createNewEntity();

        return $this->createAndHandleForm($entity, $request, 'create');
    }

    /**
     * @param integer $id
     * @param Request $request
     * @throws NotFoundHttpException
     * @return RedirectResponse|Response
     */
    public function editAction($id, Request $request) : Response
    {
        $this->denyAccessUnlessGranted(
            $this->getReadAccessLevel(),
            null,
            $this->getAccessDeniedMessage()
        );

        $entity = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        if (is_null($entity)) {
            throw new NotFoundHttpException(
                $this->get('translator')->trans(
                    $this->getTranslationDomain() . '.not_found',
                    array(),
                    $this->getTranslationDomain()
                )
            );
        }

        return $this->createAndHandleForm($entity, $request, 'edit', array('id' => $entity->getId()));
    }

    /**
     * @param integer $id
     * @param Request $request
     * @throws NotFoundHttpException
     * @return Response
     */
    public function showAction($id, Request $request) : Response
    {
        $this->denyAccessUnlessGranted(
            $this->getReadAccessLevel(),
            null,
            $this->getAccessDeniedMessage()
        );

        $entity = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        if (is_null($entity)) {
            throw new NotFoundHttpException(
                $this->get('translator')->trans(
                    $this->getTranslationDomain() . '.not_found',
                    array(),
                    $this->getTranslationDomain()
                )
            );
        }

        $categories = null;
        if ($entity instanceof Related) {
            $categories = $this->loopRelated($entity);
        }

        return $this->render(
            sprintf('%s/show.html.twig', $this->getTemplateBasePath()),
            array(
                'entity' => $entity,
                'categories' => $categories
            )
        );
    }

    /**
     * @return Response
     */
    public function listAction() : Response
    {
        $this->denyAccessUnlessGranted(
            $this->getReadAccessLevel(),
            null,
            $this->getAccessDeniedMessage()
        );

        $entities = $this->getDoctrine()->getRepository($this->getEntityName())->findAll();

        return $this->render(
            sprintf('%s/list.html.twig', $this->getTemplateBasePath()),
            array(
                'entities' => $entities,
            )
        );
    }

    /**
     * @param string $action
     * @param array  $options
     * @return string
     */
    protected function generateUrlForAction($action, array $options = array()) : string
    {
        return $this->generateUrl(
            sprintf('%s_%s', $this->getRoutePrefix(), $action),
            $options
        );
    }

    /**
     * @param AbstractModel $entity
     * @return null;
     */
    protected function handleValidForm(AbstractModel $entity)
    {
        $repository = $this->getDoctrine()->getRepository($this->getEntityName());
        $repository->save($entity, $this->getUser());

        $this->addFlash('success', 'Speichern erfolgreich');

        return null;
    }

    /**
     * @return AbstractModel
     */
    abstract protected function createNewEntity() : AbstractModel;

    /**
     * @return string
     */
    abstract protected function getFormType() : string;

    /**
     * @return string
     */
    abstract protected function getTemplateBasePath() : string;

    /**
     * @return string
     */
    abstract protected function getEntityName() : string;

    /**
     * @return string
     */
    abstract protected function getRoutePrefix() : string;

    /**
     * @return string
     */
    abstract protected function getTranslationDomain() : string;

    /**
     * @return string
     */
    abstract protected function getReadAccessLevel() : string;

    /**
     * @return string
     */
    abstract protected function getWriteAccessLevel() : string;

    /**
     * @return string
     */
    abstract protected function getPublishAccessLevel() : string;

    /**
     * @return string
     */
    protected function getAccessDeniedMessage() : string
    {
        return $this->get('translator')->trans(
            $this->getTranslationDomain() . '.access_denied',
            array(),
            $this->getTranslationDomain()
        );
    }

    /**
     * @param AbstractModel $entity
     * @param Request       $request
     * @param string        $action
     * @param array         $options
     * @return RedirectResponse|Response
     */
    protected function createAndHandleForm(
        AbstractModel $entity,
        Request $request,
        $action,
        array $options = array()
    ) : Response {
    
        $form = $this->createForm(
            $this->getFormType(),
            $entity,
            array(
                'action' => $this->generateUrlForAction($action, $options),
                'method' => 'POST',
            )
        );

        if (in_array($request->getMethod(), ['POST'])) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                if ($form->get('saveAndPublish')->isClicked()) {
                    $entity->setPublished(1);
                }

                $this->handleValidForm($entity);

                return $this->redirect($this->generateUrlForAction('edit', array('id' => $entity->getId())));
            }
        }

        return $this->render(
            sprintf('%s/edit.html.twig', $this->getTemplateBasePath()),
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @param Related $entity
     * @return array
     */
    private function loopRelated(Related $entity) : array
    {
        $franchises = null;
        $games = null;
        $expansions = null;
        $resultList = $this->getRelatedArticles($entity);
        if ($entity instanceof Publisher) {
            $franchises = $entity->getFranchises();
        } elseif ($entity instanceof Franchise) {
            $games = $entity->getGames();
        } elseif ($entity instanceof Studio) {
            $franchises = $entity->getFranchises();
            $games = $entity->getGames();
        } elseif ($entity instanceof Game) {
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
     * @param Related $entity
     * @return \AppBundle\Entity\Article[]|array
     */
    private function getRelatedArticles(Related $entity) : array
    {
        return $this->getDoctrine()->getRepository('AppBundle:Article')->findBy(
            array('related' => $entity),
            array('publishAt' => 'DESC')
        );
    }

    /**
     * @param array $articles
     * @return array
     */
    private function mapArticlesToCategories(array $articles) : array
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
}
