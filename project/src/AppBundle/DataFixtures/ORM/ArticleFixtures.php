<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
        $articleData = json_decode(file_get_contents($path), true);

        $article = new Article();
        $article->setTitle($articleData['title']);
        $article->setContent($articleData['content']);
        $article->setPublishAt(new \DateTime($articleData['publishAt']));

        $article->setCategory($this->getReference('category-'.$articleData['category']));
        $article->setRelated($this->getReference($articleData['type'].'-'.$articleData['related']));


        if ($articleData['event']) {
            $article->setEvent($this->getReference('event-'.$articleData['event']));
        }

        $this->addReference('article-'.$article->getTitle(), $article);

        if ($articleData['author']) {
            $manager->getRepository('AppBundle:Article')->save($article,$this->getReference('user-'.$articleData['author']));
        }else{
            $manager->getRepository('AppBundle:Article')->save($article,$this->getReference('user-Admin'));
        }
    }

    /**
     * @param ContainerInterface|null $containerInterface
     */
    public function setContainer(ContainerInterface $containerInterface = null)
    {
        $this->container = $containerInterface;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 9;
    }
}
