<?php

namespace AppBundle\DataFixtures\Alice;

use Nelmio\Alice\ProcessorInterface;
use AppBundle\Entity\User;

class UserProcessor implements ProcessorInterface
{
    protected $encoder;

    /**
     * UserProcessor constructor.
     * @param \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder $encoder
     */
    public function __construct($encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * {@inheritdoc}
     */
    public function preProcess($object)
    {
        if (false === $object instanceof User) {
            return;
        }

        $password = $this->encoder->encodePassword($object, $object->getPassword());
        $object->setPassword($password);
    }

    /**
     * {@inheritdoc}
     */
    public function postProcess($object)
    {
    }
}
