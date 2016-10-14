<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class UserService
 */
class UserService
{
    /** @var  EntityManager */
    private $manager;

    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
        $this->repository = $manager->getRepository('AppBundle:User');
    }

    /**
     * @return boolean
     */
    public function exportEntities()
    {
        $users = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var User $user
         */
        foreach ($users as $user) {
            $item = $xml->addChild('item');

            $item->username = null;
            $item->username->addCData($user->getUsername());

            $item->email = null;
            $item->email->addCData($user->getEmail());

            $item->password = null;
            $item->password->addCData($user->getPassword());

            $item->active = null;
            $item->active->addCData($user->isActive());

            foreach ($user->getRoles() as $role) {
                $item->addChild('role', $role->getName());
            }
        }

        $xml->saveXML('web/export/user.xml');

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/user.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $user = new User();
            $user->setUsername("$item->username");
            $user->setEmail("$item->email");
            $user->setPassword("$item->password");
            $user->setActive(intval("$item->active"));

            $profile = $this->manager->getRepository('AppBundle:Profile')->findOneBy(
                array(
                    'user' => $user
                )
            );

            if (!is_null($profile)) {
                $user->setProfile($profile);
            }

            foreach ($item->role as $role) {
                $assignedRole = $this->manager->getRepository('AppBundle:Role')->findOneBy(
                    array(
                        'name' => "$role"
                    )
                );

                $user->addRole($assignedRole);
            }

            $this->repository->save($user);
        }

        return true;
    }
}
