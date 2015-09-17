<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleVersion;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ArticleRepository
 */
class ArticleRepository extends AbstractRepository
{
    /**
     * @param Article $article Article to version.
     * @return ArticleVersion
     */
    public function saveVersion(Article $article)
    {
        $version = new ArticleVersion();
        $version->setTitle($article->getTitle());
        $version->setSlug($article->getSlug());
        $version->setContent($article->getContent());
        $version->setPublishAt($article->getPublishAt());
        $version->setPublished($article->isPublished());
        $version->setSlideshow($article->isSlideshow());
        $version->setCategory($article->getCategory());
        $version->setCreatedBy($article->getModifiedBy());
        $version->setEvent($article->getEvent());
        $version->setRelated($article->getRelated());
        $version->setThumbnail($article->getThumbnail());
        $version->setTags($article->getTags());

        $repository = $this->getEntityManager()->getRepository('AppBundle:ArticleVersion');
        $repository->save($version);

        return $version;
    }
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

        $article->addVersion($this->saveVersion($article));

        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
