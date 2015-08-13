<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    /**
     * @param Category $category
     */
    public function save(Category $category)
    {
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($category->getName()));
        $category->setSlug($slug);
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Category $category
     */
    public function delete(Category $category)
    {
        $this->getEntityManager()->remove($category);
    }
}
