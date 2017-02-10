<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\User;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Role;
use AppBundle\Entity\Article;

/**
 * Class UserTest
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group entity
     * @group user
     * @return null
     */
    public function testEntity()
    {
        $user = new User();

        $username = 'Username';
        $user->setUsername($username);
        $this->assertEquals($user->getUsername(), $username);

        $password = '1234';
        $user->setPassword($password);
        $this->assertEquals($user->getPassword(), $password);

        $email = 'user@abc.com';
        $user->setEmail($email);
        $this->assertEquals($user->getEmail(), $email);

        $active = 1;
        $user->setActive($active);
        $this->assertEquals($user->isActive(), $active);

        $now = new \DateTime();
        $user->setValidUntil($now);
        $this->assertEquals($user->getValidUntil(), $now);

        $user->setCreatedAt();
        $this->assertNotEmpty($user->getCreatedAt());

        $user->setModifiedAt();
        $this->assertNotEmpty($user->getModifiedAt());

        $profile = $this->getMockBuilder(Profile::class)->getMock();
        $user->setProfile($profile);
        $this->assertEquals($user->getProfile(), $profile);

        $role = $this->getMockBuilder(Role::class)->getMock();

        $user->addRole($role);
        $this->assertEquals($user->getRoles(), array($role));

        $user->removeRole($role);
        $this->assertEquals($user->getRoles(), array());

        $article = $this->getMockBuilder(Article::class)->getMock();

        $user->addArticle($article);
        $this->assertEquals($user->getArticles(), array($article));

        $user->removeArticle($article);
        $this->assertEquals($user->getArticles(), array());

        return null;
    }
}
