<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Nelmio\Alice\Fixtures;

/**
 * Class RoleFixtures
 */
class DevFixtures extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save role.
     * @return null
     */
    public function load(ObjectManager $manager)
    {
        /** @var Fixtures $fixtureLoader */
        $fixtureLoader = $this->container->get('alice.fixtures');
        $fixtureLoader->loadFiles(__DIR__.'/../../../../../app/Resources/fixtures/fixtures_dev.yml');

        return null;
    }

    /**
     * @param ContainerInterface|null $containerInterface ContainerInterface.
     * @return $this
     */
    public function setContainer(ContainerInterface $containerInterface = null)
    {
        $this->container = $containerInterface;

        return $this;
    }
}
