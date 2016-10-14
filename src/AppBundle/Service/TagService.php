<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Tag;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class TagService
 */
class TagService
{
    /**
     * @var \AppBundle\Repository\TagRepository
     */
    private $repository;
    
    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->repository = $manager->getRepository('AppBundle:Tag');
    }

    /**
     * @return boolean
     */
    public function exportEntities()
    {
        $tags = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Tag $tag
         */
        foreach ($tags as $tag) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($tag->getName());

            $item->published = null;
            $item->published->addCData($tag->isPublished());

            foreach ($tag->getArticles() as $article) {
                $item->addChild('article', $article->getSlug());
            }
        }

        $xml->saveXML('web/export/tag.xml');

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/tag.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $tag = new Tag();
            $tag->setName("$item->name");
            $tag->setPublished(intval("$item->published"));

            foreach ($item->article as $article) {
                $taggedArticle = $this->manager->getRepository('AppBundle:Article')->findOneBy(
                    array(
                        'slug' => "$article"
                    )
                );

                $tag->addArticle($taggedArticle);
            }

            $this->repository->save($tag);
        }

        return true;
    }
}
