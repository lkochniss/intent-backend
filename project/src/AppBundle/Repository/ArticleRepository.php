<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Article;

/**
 * ArticleRepository
 */
class ArticleRepository extends AbstractRepository
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
     * @return string
     */
    protected function getListDQL()
    {
        return 'SELECT c
            FROM ' . $this->getEntityName() . ' c
            ORDER BY c.modifiedAt DESC';
    }
}
