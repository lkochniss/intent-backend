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
     * @param ObjectManager $manager Manager to save role.
     * @return null
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

    /**
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
