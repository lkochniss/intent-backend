<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Role;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class RoleService
 */
class RoleService
{
    /**
 * @var  EntityManager
*/
    private $manager;

    /**
 * @var  EntityRepository
*/
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
        $this->repository = $manager->getRepository('AppBundle:Role');
    }

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

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/role.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $role = new Role();
            $role->setName("$item->name");
            $role->setRole("$item->role");

            $this->repository->save($role);
        }

        return true;
    }
}
