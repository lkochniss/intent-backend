<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

class ArticleFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $dataDirectory = __DIR__.'/../data/articles';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            $count++;

            $this->saveArticle($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function saveArticle(ObjectManager $manager, $path, $count)
    {
        $xml = new \SimpleXMLElement(file_get_contents($path));
        foreach ($xml->channel->item as $item) {

            $namespaces = $item->getNameSpaces(true);
            $dc = $item->children($namespaces['dc']);
            $content = $item->children($namespaces['content']);
            $wp = $item->children($namespaces['wp']);

            //<category domain="category" nicename="featured"><![CDATA[Featured]]></category>


            $article = new Article();
            $article->setTitle("$item->title");
            $article->setPublishAt(new \DateTime("$wp->post_date"));
            $article->setPublished(true);
            $article->setContent("$content->encoded");
            foreach ($item->category as $category) {
                foreach ($category->attributes() as $a => $b) {
                    if ($b == 'category') {
                        $article->setCategory($this->getReference('category-'."$category"));
                    }
                }
            }

            $manager->getRepository('AppBundle:Article')->save(
                $article,
                $this->getReference('user-'."$dc->creator")
            );
        }
    }

    /**
     * @param ContainerInterface|null $containerInterface
     */
    public
    function setContainer(
        ContainerInterface $containerInterface = null
    ) {
        $this->container = $containerInterface;
    }

    /**
     * @return int
     */
    public
    function getOrder()
    {
        return 10;
    }
}
