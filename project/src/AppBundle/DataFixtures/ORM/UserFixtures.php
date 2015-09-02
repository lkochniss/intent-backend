<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/user.xml'));

        foreach ($xml->item as $item) {
            $user = new User();
            $user->setUsername("$item->username");
            $user->setEmail("$item->email");
            $user->setIsActive("$item->active");
            $user->setPassword("$item->password");

            foreach ($item->role as $role) {
                $user->addRole($this->getReference("$role"));
            }

            $manager->getRepository('AppBundle:User')->save(
                $user
            );

            $this->addReference('user-'.$user->getUsername(), $user);
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
        return 2;
    }
}
