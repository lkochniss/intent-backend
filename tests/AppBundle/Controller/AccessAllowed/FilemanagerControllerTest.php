<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Directory;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class FilemanagerControllerTest
 */
class FilemanagerControllerTest extends AbstractControllerTest
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
        parent::setUp();

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
        $crawler = $this->pageResponse('GET', sprintf('/filemanager/0/create/%s', $this->directory->getId()));

        $crawler = $this->pageResponse('GET', sprintf('/filemanager/1/create/%s', $this->directory->getId()));

        return null;
    }

    /**
     * @group controller
     * @group image
     * @return null
     */
    public function testUploadPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/filemanager/0/upload/%s', $this->directory->getId()));


        $crawler = $this->pageResponse('GET', sprintf('/filemanager/1/upload/%s', $this->directory->getId()));

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
        $crawler = $this->pageResponse('GET', '/filemanager/0');
        /**
         * as popup
         */
        $crawler = $this->pageResponse('GET', '/filemanager/1');

        return null;
    }

    /**
     * @return string
     */
    protected function getUsername()
    {
        return 'Publishing Editor';
    }
    /**
     * @return string
     */
    protected function getPassword()
    {
        return 'publishing';
    }
}
