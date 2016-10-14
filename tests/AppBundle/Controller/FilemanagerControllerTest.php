<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller;

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
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/filemanager/0/create/%s', $this->directory->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="directory_name"]');
        $this->checkIfOneContentExist($crawler, 'button[id="directory_submit"]');

        $crawler = $this->pageResponse('GET', sprintf('/filemanager/1/create/%s', $this->directory->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="directory_name"]');
        $this->checkIfOneContentExist($crawler, 'button[id="directory_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testUploadPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/filemanager/0/upload/%s', $this->directory->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="upload_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="upload_description"]');
        $this->checkIfOneContentExist($crawler, 'input[id="upload_file"]');
        $this->checkIfOneContentExist($crawler, 'button[id="upload_submit"]');


        $crawler = $this->pageResponse('GET', sprintf('/filemanager/1/upload/%s', $this->directory->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="upload_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="upload_description"]');
        $this->checkIfOneContentExist($crawler, 'input[id="upload_file"]');
        $this->checkIfOneContentExist($crawler, 'button[id="upload_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        /**
         * with sidebar and adminbar
         */
        $crawler = $this->pageResponse('GET', '/filemanager/0');

        $this->checkIfOneContentExist(
            $crawler,
            sprintf('a[href="/filemanager/0/upload/%s"]', $this->directory->getId())
        );

        $this->checkIfOneContentExist(
            $crawler,
            sprintf('a[href="/filemanager/0/create/%s"]', $this->directory->getId())
        );

        /**
         * as popup
         */
        $crawler = $this->pageResponse('GET', '/filemanager/1');

        $this->checkIfOneContentExist(
            $crawler,
            sprintf('a[href="/filemanager/1/upload/%s"]', $this->directory->getId())
        );

        $this->checkIfOneContentExist(
            $crawler,
            sprintf('a[href="/filemanager/1/create/%s"]', $this->directory->getId())
        );

        return null;
    }
}
