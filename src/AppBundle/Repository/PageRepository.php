<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Page;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PageRepository
 */
class PageRepository extends AbstractRepository
{
    /**
     * @param Page $page Persist page.
     * @return JsonResponse
     */
    public function save(Page $page)
    {
        $slug = $this->slugify($page->getTitle());
        $page->setSlug($slug);
        $this->getEntityManager()->persist($page);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
