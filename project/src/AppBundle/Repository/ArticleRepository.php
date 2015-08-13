<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 */
class ArticleRepository extends EntityRepository
{
    /**
     * @param Article $article
     */
    public function save(Article $article)
    {
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($article->getTitle()));
        $article->setSlug($slug);
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Article $article
     */
    public function delete(Article $article)
    {
        $this->getEntityManager()->remove($article);
    }
}
