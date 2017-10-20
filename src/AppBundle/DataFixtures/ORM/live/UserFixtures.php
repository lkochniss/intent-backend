<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class UserFixtures
 */
class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/user.xml'));

        foreach ($xml->item as $item) {
            $user = new User();
            $user->setUsername("$item->username");
            $user->setEmail("$item->email");
            $user->setActive("$item->active");
            $user->setPassword("$item->password");

            foreach ($item->role as $role) {
                $user->addRole($this->getReference("$role"));
            }

            $manager->getRepository('AppBundle:User')->save(
                $user
            );

            $this->addReference('user-' . $user->getUsername(), $user);
        }
    }

    /**
     * @param ContainerInterface|null $containerInterface
     * @return UserFixtures
     */
    public function setContainer(ContainerInterface $containerInterface = null) : UserFixtures
    {
        $this->container = $containerInterface;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder() : int
    {
        return 2;
    }
}
