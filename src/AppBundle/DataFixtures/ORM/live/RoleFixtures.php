<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Role;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RoleFixtures
 */
class RoleFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/role.xml'));

        foreach ($xml->item as $item) {
            $role = new Role();
            $role->setName("$item->name");
            $role->setRole("$item->role");

            $manager->getRepository('AppBundle:Role')->save(
                $role
            );

            $this->addReference('role-' . $role->getName(), $role);
        }
    }

    /**
     * @param ContainerInterface|null $containerInterface
     * @return RoleFixtures
     */
    public function setContainer(ContainerInterface $containerInterface = null) : RoleFixtures
    {
        $this->container = $containerInterface;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder() : int
    {
        return 1;
    }
}
