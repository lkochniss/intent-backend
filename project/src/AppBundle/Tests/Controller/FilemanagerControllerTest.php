<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Directory;

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
     * @return null
     * @Sup
     */
    public function testCreatePage()
    {
        $this->pageResponse('GET', sprintf('/filemanager/0/create/%s', $this->directory->getId()));
        $this->pageResponse('GET', sprintf('/filemanager/1/create/%s', $this->directory->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testUploadPage()
    {
        $this->pageResponse('GET', sprintf('/filemanager/0/upload/%s', $this->directory->getId()));
        $this->pageResponse('GET', sprintf('/filemanager/1/upload/%s', $this->directory->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $this->pageResponse('GET', '/filemanager/0');
        $this->pageResponse('GET', '/filemanager/1');

        return null;
    }
}
