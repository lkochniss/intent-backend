<?php
/**
 * Class UserExport
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class UserExport
 * @package AppBundle\Service
 */
class UserExport
{
    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityRepository $repository Get the entity repository.
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;

        return null;
    }

    /**
     * @return boolean
     */
    public function exportEntity()
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
            $item->active->addCData($user->getIsActive());

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
