<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Publisher;

/**
 * PublisherRepository
 */
class PublisherRepository extends AbstractRepository
{
    /**
     * @param Publisher $publisher
     */
    public function save(Publisher $publisher)
    {
        $slug = $this->slugify($publisher->getName());
        $publisher->setSlug($slug);
        $this->getEntityManager()->persist($publisher);
        $this->getEntityManager()->flush();
    }
}
