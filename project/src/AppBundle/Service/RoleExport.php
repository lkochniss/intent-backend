<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Role;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class RoleExport
 */
class RoleExport
{
    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityRepository $repository Get the entity repository.
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return boolean
     */
    public function exportEntity()
    {
        $roles = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Role $role
         */
        foreach ($roles as $role) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($role->getName());

            $item->role = null;
            $item->role->addCData($role->getRole());
        }

        $xml->saveXML('web/export/role.xml');

        return true;
    }
}
