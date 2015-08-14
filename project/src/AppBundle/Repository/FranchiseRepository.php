<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Franchise;
use AppBundle\Entity\Game;
use Doctrine\ORM\EntityRepository;

/**
 * FranchiseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FranchiseRepository extends AbstractRepository
{
    /**
     * @param Franchise $franchise
     */
    public function save(Franchise $franchise)
    {
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($franchise->getName()));
        $franchise->setSlug($slug);
        $this->getEntityManager()->persist($franchise);
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
