<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityRepository;

/**
 * Class ImageExport
 * @package AppBundle\Service
 */
class ImageExport
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

    }
}
