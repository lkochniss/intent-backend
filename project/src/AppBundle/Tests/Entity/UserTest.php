<?php
/**
 * @package AppBundle\Tests\Entity
 */

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\User;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Role;
use AppBundle\Entity\Article;

/**
 * Class UserTest
 * @package AppBundle\Tests\Controller
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
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
        $user->setIsActive($active);
        $this->assertEquals($user->getIsActive(), $active);

        $now = new \DateTime();
        $user->setValidUntil($now);
        $this->assertEquals($user->getValidUntil(), $now);

        $user->setCreatedAt();
        $this->assertNotEmpty($user->getCreatedAt());

        $user->setModifiedAt();
        $this->assertNotEmpty($user->getModifiedAt());

        $profile = $this->getMock(Profile::class);
        $user->setProfile($profile);
        $this->assertEquals($user->getProfile(), $profile);

        $role = $this->getMock(Role::class);

        $user->addRole($role);
        $this->assertEquals($user->getRoles(), array($role));

        $user->removeRole($role);
        $this->assertEquals($user->getRoles(), array());

        $article = $this->getMock(Article::class);

        $user->addArticle($article);
        $this->assertEquals($user->getArticles(), array($article));

        $user->removeArticle($article);
        $this->assertEquals($user->getArticles(), array());

        return null;
    }
}
