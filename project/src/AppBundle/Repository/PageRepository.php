<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Page;

/**
 * PageRepository
 */
class PageRepository extends AbstractRepository
{
    /**
     * @param Page $page
     */
    public function save(Page $page)
    {
        $slug = $this->slugify($page->getTitle());
        $page->setSlug($slug);
        $this->getEntityManager()->persist($page);
        $this->getEntityManager()->flush();
    }
}
