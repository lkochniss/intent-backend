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
    /**
     * @var \AppBundle\Repository\ProfileRepository
     */
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
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

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/profile.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $user = $this->manager->getRepository('AppBundle:User')->findOneBy(
                array(
                    'username' => "$item->user"
                )
            );

            $profile = $this->manager->getRepository('AppBundle:Profile')->findOneBy(
                array(
                    'user' => $user
                )
            );

            $profile = !is_null($profile) ? $profile : new Profile();

            $profile->setName("$item->name");
            $profile->setDescription("$item->description");

            if ("$item->user" != '') {
                $profile->setUser(
                    $this->manager->getRepository('AppBundle:User')->findOneBy(
                        array(
                            'username' => "$item->user"
                        )
                    )
                );
            }

            $this->repository->save($profile);
        }

        return true;
    }
}
