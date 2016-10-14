<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Profile;
use AppBundle\Entity\User;

/**
 * Class ProfileTest
 */
class ProfileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $profile = new Profile();

        $name = 'Userprofile';
        $profile->setName($name);
        $this->assertEquals($profile->getName(), $name);

        $description = 'Profile of User';
        $profile->setDescription($description);
        $this->assertEquals($profile->getDescription(), $description);

        $profile->setCreatedAt();
        $this->assertNotNull($profile->getCreatedAt());

        $profile->setModifiedAt();
        $this->assertNotNull($profile->getModifiedAt());

        $user = $this->getMock(User::class);
        $profile->setUser($user);
        $this->assertEquals($profile->getUser(), $user);

        return null;
    }
}
