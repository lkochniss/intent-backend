<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Expansion;

/**
 * Class ExpansionRepository
 * @package AppBundle\Repository
 */
class ExpansionRepository extends AbstractRepository
{
    /**
     * @param Expansion $expansion
     */
    public function save(Expansion $expansion)
    {
        $slug = $this->slugify($expansion->getName());
        $expansion->setSlug($slug);
        $this->getEntityManager()->persist($expansion);
        $this->getEntityManager()->flush();
    }
}
