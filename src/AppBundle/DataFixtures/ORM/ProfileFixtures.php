<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Directory;
use AppBundle\Entity\Profile;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ProfileFixtures
 */
class ProfileFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save profile.
     * @return boolean
     */
    public function load(ObjectManager $manager)
    {
//        $xml = new SimpleXMLExtended(file_get_contents('web/export/profile.xml'));
//
//        foreach ($xml->item as $item) {
//            $profile = new Profile();
//            $profile->setName("$item->name");
//            $profile->setDescription("$item->description");
//
//            if ("$item->user" != '') {
//                $profile->setUser($this->getReference('user-' . "$item->user"));
//            }
//
//            $manager->getRepository('AppBundle:Profile')->save(
//                $profile
//            );
//            $this->addReference('profile-' . $profile->getName(), $profile);
//        }

        return true;
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
        return 3;
    }
}
