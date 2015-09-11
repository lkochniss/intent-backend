<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\AbstractModel;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository extends EntityRepository
{
    /**
     * @param string $string String to slugify.
     * @return string
     */
    protected function slugify($string)
    {
        return preg_replace('/[^a-z0-9]+/', '-', strtolower($string));
    }

    /**
     * @param AbstractModel $entity Delete entity.
     * @return boolean
     */
    public function delete(AbstractModel $entity)
    {
        $this->getEntityManager()->remove($entity);

        return true;
    }
}
