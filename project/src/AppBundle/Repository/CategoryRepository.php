<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;

/**
 * CategoryRepository
 */
class CategoryRepository extends AbstractRepository
{
    /**
     * @param Category $category
     */
    public function save(Category $category)
    {
        $slug = $this->slugify($category->getName());
        $category->setSlug($slug);
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();
    }
}
