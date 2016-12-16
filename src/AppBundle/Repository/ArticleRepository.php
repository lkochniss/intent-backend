<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ArticleRepository
 */
class ArticleRepository extends AbstractRepository
{

    /**
     * @param Article $article Persist article.
     * @param User    $user    Set author to user.
     * @return JsonResponse
     */
    public function save(Article $article, User $user)
    {
        $slug = $this->slugify($article->getTitle());
        $article->setSlug($slug);

        if (is_null($article->getCreatedBy())) {
            $article->setCreatedBy($user);
        }

        $article->setModifiedBy($user);

        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
