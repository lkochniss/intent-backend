<?php

namespace AppBundle\DataFixtures\ORM;

use AppBUndle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $dataDirectory = __DIR__.'/../data/categories';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            $count++;

            $this->saveCategory($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function saveCategory(ObjectManager $manager, $path, $count)
    {
        $categoryData = json_decode(file_get_contents($path), true);

        $category = new Category();
        $category->setName($categoryData['name']);
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($category->getName()));
        $category->setSlug($slug);
        $category->setPriority($categoryData['order']);

        $this->addReference('category-'.$category->getName(), $category);

        $manager->getRepository('AppBundle:Category')->save($category);
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
        return 8;
    }
}
