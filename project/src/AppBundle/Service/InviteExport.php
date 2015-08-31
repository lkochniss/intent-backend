<?php

namespace AppBundle\Service;

use AppBundle\Entity\Invite;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class InviteExport
 * @package AppBundle\Service
 */
class InviteExport
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
        $invites = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Invite $invite
         */
        foreach ($invites as $invite) {
            $item = $xml->addChild('item');

            $item->username = null;
            $item->username->addCData($invite->getUsername());

            $item->email = null;
            $item->email->addCData($invite->getEmail());

            $item->token = null;
            $item->token->addCData($invite->getToken());

            $item->createdAt = null;
            $item->createdAt->addCData($invite->getCreatedAt()->format('Y-M-d H:i:s'));
        }

        $xml->saveXML('web/export/invite.xml');
    }
}
