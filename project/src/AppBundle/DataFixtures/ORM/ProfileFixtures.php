<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Directory;
use AppBundle\Entity\Profile;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProfileFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/profile.xml'));

        foreach ($xml->item as $item) {
            $profile = new Profile();
            $profile->setName("$item->name");
            $profile->setDescription("$item->description");

            if("$item->user" != ""){
                $profile->setUser($this->getReference('user-'."$item->user"));
            }

            $manager->getRepository('AppBundle:Profile')->save(
                $profile
            );
            $this->addReference('profile-'.$profile->getName(), $profile);
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
        return 3;
    }
}
