<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements AdvancedUserInterface, EquatableInterface, \Serializable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var Role
     */
    private $role;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param string $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param Role $role
     * @return $this
     */
    public function setRole(Role $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    public function serialize()
    {
        return serialize(
            array(
                $this->id,
                $this->username,
                $this->password,
                $this->isActive,
            )
        );
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            )
            = unserialize($serialized);
    }

    public function getSalt()
    {
        return null;
    }

    public function isAccountNonexpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function getRoles()
    {
        return array($this->role);
    }

    public function eraseCredentials()
    {

    }

    public function isEqualTo(UserInterface $user)
    {
        if ($user instanceof User){
            $isEqual = count($this->getRoles()) == count($user->getRoles());
            if($isEqual){
                foreach ($this->getRoles() as $role) {
                    $isEqual = $isEqual && in_array($role, $user->getRoles());
                }
            }

            return $isEqual;
        }

        return false;
    }
}
