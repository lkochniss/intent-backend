<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Article;
use AppBundle\Entity\Expansion;
use AppBundle\Entity\Franchise;
use AppBundle\Entity\Game;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Studio;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;

/**
 * ArticleRepository
 */
class ArticleRepository extends AbstractRepository
{
    protected function getTag($name)
    {
        $slug = $this->slugify($name);
        $tag = $this->getEntityManager()->getRepository('AppBundle:Tag')->findOneBy(array('slug' => $slug));

        if (is_null($tag)) {
            $tag = new Tag();
            $tag->setName($name);
            $tag->setSlug($slug);
            $this->getEntityManager()->persist($tag);
            $this->getEntityManager()->flush();

            return $tag;
        }

        return $tag;
    }

    /**
     * @param Article $article
     */
    protected function saveTags(Article $article)
    {
        $related = $article->getRelated();
        $event = $article->getEvent();

        $publisher = null;
        $franchise = null;
        $studio = null;
        $game = null;
        $expansion = null;

        $article->resetTags();

        if ($related instanceof Publisher) {
            $publisher = $related;
        } elseif ($related instanceof Studio) {
            $studio = $related;
        } elseif ($related instanceof Franchise) {
            $franchise = $related;
        } elseif ($related instanceof Game) {
            $game = $related;
        }elseif ($related instanceof Expansion) {
            $expansion = $related;
        }

        if(!is_null($expansion)){
            $article->addTag($this->getTag($expansion->getName()));
            $game = $expansion->getGame();
        }

        if (!is_null($game)) {
            $article->addTag($this->getTag($game->getName()));
            $franchise = $game->getFranchise();
            $studio = $game->getStudio();
        }

        if (!is_null($franchise)) {
            $article->addTag($this->getTag($franchise->getName()));
            if (is_null($studio)) {
                $studio = $franchise->getStudio();
            }
            $publisher = $franchise->getPublisher();
        }

        if (!is_null($studio)) {
            $article->addTag($this->getTag($studio->getName()));
        }

        if (!is_null($publisher)) {
            $article->addTag($this->getTag($publisher->getName()));
        }

        if (!is_null($event)) {
            $article->addTag($this->getTag($event->getName()));
        }
    }

    /**
     * @param Article $article
     * @param User $user
     */
    public function save(Article $article, User $user)
    {
        $slug = $this->slugify($article->getTitle());
        $article->setSlug($slug);

        if (is_null($article->getCreatedBy())) {
            $article->setCreatedBy($user);
        }

        $article->setModifiedBy($user);

        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();

        $this->saveTags($article);
    }
}
