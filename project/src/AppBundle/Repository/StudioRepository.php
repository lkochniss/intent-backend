<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Studio;

/**
 * GameRepository
 */
class StudioRepository extends AbstractRepository
{
    /**
     * @param Studio $studio
     */
    public function save(Studio $studio)
    {
        $slug = $this->slugify($studio->getName());
        $studio->setSlug($slug);
        $this->getEntityManager()->persist($studio);
        $this->getEntityManager()->flush();
    }
}
