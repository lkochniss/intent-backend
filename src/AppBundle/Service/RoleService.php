<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Role;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class RoleService
 */
class RoleService
{
    /** @var  EntityRepository */
    private $repository;

    /**
     * @return boolean
     */
    public function exportEntities()
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
