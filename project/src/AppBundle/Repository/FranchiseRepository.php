<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Franchise;

/**
 * FranchiseRepository
 */
class FranchiseRepository extends AbstractRepository
{
    /**
     * @param Franchise $franchise
     */
    public function save(Franchise $franchise)
    {
        $slug = $this->slugify($franchise->getName());
        $franchise->setSlug($slug);
        $this->getEntityManager()->persist($franchise);
        $this->getEntityManager()->flush();
    }
}
