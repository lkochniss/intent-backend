<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\ArticleVersion;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ArticleVersionRepository
 */
class ArticleVersionRepository extends AbstractRepository
{
    /**
     * @param ArticleVersion $article Persist article.
     * @return JsonResponse
     */
    public function save(ArticleVersion $article)
    {
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
