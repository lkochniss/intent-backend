<?php
/**
 * @package Test\AppBundle\Controller\AccessDenied
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Directory;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class FilemanagerControllerAccessDeniedTest
 */
class FilemanagerControllerAccessDeniedTest extends AbstractControllerTest
{
    /**
     * @var Directory
     */
    protected $directory;

    /**
     * @return $this
     */
    public function setUp()
    {
        $this->setClient('0-Permission-User', 'no permission');
        $this->setEntityManager();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Directory');
        $this->directory = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group image
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/filemanager/0/create/%s', $this->directory->getId()), 403);

        $crawler = $this->pageResponse('GET', sprintf('/filemanager/1/create/%s', $this->directory->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group image
     * @return null
     */
    public function testUploadPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/filemanager/0/upload/%s', $this->directory->getId()), 403);


        $crawler = $this->pageResponse('GET', sprintf('/filemanager/1/upload/%s', $this->directory->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group image
     * @return null
     */
    public function testListPage()
    {
        /**
         * with sidebar and adminbar
         */
        $crawler = $this->pageResponse('GET', '/filemanager/0', 403);
        /**
         * as popup
         */
        $crawler = $this->pageResponse('GET', '/filemanager/1', 403);

        return null;
    }
}
