<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Profile;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class ProfileService
 */
class ProfileService
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
        $this->repository = $manager->getRepository('AppBundle:Profile');
    }

    /**
     * @return boolean
     */
    public function exportEntities()
    {
        $profiles = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Profile $profile
         */
        foreach ($profiles as $profile) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($profile->getName());

            $item->description = null;
            $item->description->addCData($profile->getDescription());

            $item->user = null;
            if (!is_null($profile->getUser()->getUsername())) {
                $item->user->addCData($profile->getUser()->getUsername());
            }
        }

        $xml->saveXML('web/export/profile.xml');

        return true;
    }
}