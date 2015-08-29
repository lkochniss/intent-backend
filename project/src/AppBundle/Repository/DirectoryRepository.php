<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Directory;

/**
 * Class DirectoryRepository
 * @package AppBundle\Repository
 */
class DirectoryRepository extends AbstractRepository
{
    /**
     * @param Directory $directory
     */
    public function save(Directory $directory)
    {
        $path = $this->slugify($directory->getName());
        $directory->setPath($path);

        $this->getEntityManager()->persist($directory);
        $this->getEntityManager()->flush();
    }
}
