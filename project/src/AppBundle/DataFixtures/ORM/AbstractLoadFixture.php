<?php

namespace AppBundle\DataFixtures\ORM;

use AppBUndle\Entity\Role;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractLoadFixture implements FixtureInterface, ContainerAwareInterface
{
    /** @var  ContainerInterface */
    private $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var Fixtures $fixtureLoader */
        $fixtureLoader->loadFiles($this->getFixturePath());
    }

    /**
     * @return string
     */
    protected function getFixturePath()
    {
        return sprintf(
            '%s/%s/%s',
            $this->container->getParameter('kernel.root_dir'),
            'Resources/fixtures',
            $this->getFixtureYmlFile()
        );
    }

    /**
     * @return string
     */
    abstract protected function getFixtureYmlFile();
}
