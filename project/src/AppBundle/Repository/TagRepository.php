<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Tag;
use AppBundle\Entity\User;

/**
 * TagRepository
 */
class TagRepository extends AbstractRepository
{
    /**
     * @param Tag $tag
     */
    public function save(Tag $tag)
    {
        $slug = $this->slugify($tag->getName());
        $tag->setSlug($slug);
        $this->getEntityManager()->persist($tag);
        $this->getEntityManager()->flush();
    }
}
