<?php

namespace AppBundle\Service;

use AppBundle\Entity\Profile;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class ProfileExport
 * @package AppBundle\Service
 */
class ProfileExport
{
    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function exportEntity()
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
            if(is_null($profile->getUser()->getUsername())){
            }
        }

        $xml->saveXML('web/export/profile.xml');
    }
}
