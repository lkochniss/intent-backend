<?php
/**
 * Class UserService
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class UserService
 */
class UserService
{
    /** @var  EntityRepository */
    private $repository;

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

            if (is_null($user->getRoles())) {
                $item->role = null;
            }
            foreach ($user->getRoles() as $role) {
                $item->addChild('role', 'role-' . $role->getName());
            }
        }

        $xml->saveXML('web/export/user.xml');

        return true;
    }
}
