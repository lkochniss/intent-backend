<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends AbstractRepository
{
    /**
     * @param Tag $tag
     */
    public function save(Tag $tag)
    {
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($tag->getName()));
        $tag->setSlug($slug);
        $this->getEntityManager()->persist($tag);
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
