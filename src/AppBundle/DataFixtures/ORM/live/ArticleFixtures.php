<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use AppBundle\Entity\Tag;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class ArticleFixtures
 */
class ArticleFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager
     * @return null
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/article.xml'));

        foreach ($xml->item as $item) {
            $article = new Article();
            $article->setTitle("$item->title");
            $article->setContent("$item->content");
            $article->setSlideshow(intval("$item->slideshow"));
            $article->setPublished(intval("$item->published"));
            $article->setPublishAt(new \DateTime("$item->publishedAt"));
            if ("$item->relatedType" != '') {
                $article->setRelated($this->getReference("$item->relatedType" . '-' . "$item->related"));
            }

            if ("$item->category" != '') {
                $article->setCategory($this->getReference("$item->category"));
            }

            if ("$item->event" != '') {
                $article->setEvent($this->getReference("$item->event"));
            }

            if ("$item->thumbnail" != '') {
                $article->setThumbnail($this->getReference("$item->thumbnail"));
            }

            foreach ($item->tag as $tag) {
                $article->addTag($this->getReference("$tag"));
            }

            $manager->getRepository('AppBundle:Article')->save(
                $article,
                $this->getReference('user-' . "$item->author")
            );
        }

        $dataDirectory = __DIR__ . '/../../data/articles';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            if ($file != 'imported') {
                $count++;
                $this->saveWordpressArticles($manager, $dataDirectory . DIRECTORY_SEPARATOR . $file, $count);
            }
        }
        $manager->flush();

        return null;
    }


    /**
     * @param ObjectManager $manager
     * @param string        $path
     */
    public function saveWordpressArticles(ObjectManager $manager, $path)
    {
        $xml = new \SimpleXMLElement(file_get_contents($path));
        $articleRepository = $manager->getRepository('AppBundle:Article');

        foreach ($xml->channel->item as $item) {
            $namespaces = $item->getNameSpaces(true);
            $dc = $item->children($namespaces['dc']);
            $content = $item->children($namespaces['content']);
            $wp = $item->children($namespaces['wp']);

            $article = new Article();
            $article->setTitle("$item->title");
            $article->setPublishAt(new \DateTime("$wp->post_date"));
            $article->setPublished(true);
            $article->setContent("$content->encoded");

            foreach ($item->category as $category) {
                foreach ($category->attributes() as $a => $b) {
                    if ($b == 'category') {
                        $article->setCategory(
                            $this->getReference(
                                'category-' . $articleRepository->slugify("$category")
                            )
                        );
                    }
                }
            }

            $articleRepository->save($article, $this->getReference('user-' . "$dc->creator"));

            foreach ($item->category as $category) {
                foreach ($category->attributes() as $a => $b) {
                    if ($b = 'post_tag') {
                        $tag = $manager->getRepository('AppBundle:Tag')->findOneBy(array('name' => "$category"));
                        if (is_null($tag)) {
                            $tag = new Tag();
                            $tag->setName("$category");
                            $manager->getRepository('AppBundle:Tag')->save($tag);
                        }
                        $article->addTag($tag);
                    }
                }
            }
        }

        $file = new File($path);
        $file->move(__DIR__ . '/../data/articles/imported');
    }

    /**
     * @param ContainerInterface|null $containerInterface
     * @return ArticleFixtures
     */
    public function setContainer(ContainerInterface $containerInterface = null) : ArticleFixtures
    {
        $this->container = $containerInterface;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder() : int
    {
        return 14;
    }
}
