<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Role;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RoleFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

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

            $this->addReference('role-'.$role->getName(), $role);
        }
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function saveRole(ObjectManager $manager, $path, $count)
    {
        $roleData = json_decode(file_get_contents($path), true);

        $role = new Role();
        $role->setName($roleData['name']);
        $role->setRole($roleData['role']);

        $this->addReference('role-'.$role->getName(), $role);

        $manager->persist($role);
        $manager->flush();
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
        return 1;
    }
}
