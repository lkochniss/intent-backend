<?php

namespace AppBundle\DataFixtures\ORM;

use AppBUndle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class RolesFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    private function load(ObjectManager $manager){

    }

    public function saveRole($roleData)
    {
        $role = new Role();
    }

    public function setContainer($containerInterface)
    {
        $this->container = $containerInterface;
    }

    public function getOrder()
    {
        return 2;
    }
}
