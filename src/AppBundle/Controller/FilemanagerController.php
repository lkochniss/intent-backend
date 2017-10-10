<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Directory;
use AppBundle\Entity\Image;
use AppBundle\Form\Type\DirectoryType;
use AppBundle\Form\Type\UploadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FilemanagerController
 */
class FilemanagerController extends Controller
{
    /**
     * @param Request $request
     * @param int     $popup
     * @param int     $id
     * @return Response
     */
    public function createAction(Request $request, $popup = 0, $id = 0) : Response
    {
        $this->denyAccessUnlessGranted(
            $this->getReadAccessLevel(),
            null,
            $this->getAccessDeniedMessage()
        );

        $directory = new Directory();
        $parentDirectory = $this->getDoctrine()->getRepository('AppBundle:Directory')->find($id);
        $form = $this->createForm(DirectoryType::class, $directory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directory->setParentDirectory($parentDirectory);
            $this->getDoctrine()->getRepository('AppBundle:Directory')->save($directory);
            $filesystem = new Filesystem();
            $filesystem->mkdir($directory->getFullPath());

            return $this->redirect($this->generateUrl('intent_backend_filemanager_list', array('id' => $id)));
        }

        if ($popup == 0) {
            return $this->render(
                ':Filemanager:default/create.html.twig',
                array(
                    'form' => $form->createView(),
                )
            );
        } else {
            return $this->render(
                ':Filemanager:popup/create.html.twig',
                array(
                    'form' => $form->createView(),
                )
            );
        }
    }

    /**
     * @param Request $request
     * @param int     $popup
     * @param int     $id
     * @return Response
     */
    public function uploadAction(Request $request, $popup = 0, $id = 0)
    {
        $this->denyAccessUnlessGranted(
            $this->getReadAccessLevel(),
            null,
            $this->getAccessDeniedMessage()
        );

        $image = new Image();
        $form = $this->createForm(UploadType::class, $image);
        $form->handleRequest($request);

        $directory = $this->getDoctrine()->getRepository('AppBundle:Directory')->find($id);
        if (is_null($directory)) {
            $directory = $this->getDoctrine()->getRepository('AppBundle:Directory')->findOneBy(
                array('parentDirectory' => null)
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $image->setParentDirectory($directory);
            $this->getDoctrine()->getRepository('AppBundle:Image')->save($image);

            return $this->redirect($this->generateUrl('intent_backend_filemanager_list', array('id' => $id)));
        }

        if ($popup == 0) {
            return $this->render(
                ':Filemanager:default/upload.html.twig',
                array(
                    'form' => $form->createView(),
                )
            );
        } else {
            return $this->render(
                ':Filemanager:popup/upload.html.twig',
                array(
                    'form' => $form->createView(),
                )
            );
        }
    }

    /**
     * @param int $popup
     * @param int $id
     * @return Response
     */
    public function listAction($popup = 0, $id = 0)
    {
        $this->denyAccessUnlessGranted(
            $this->getReadAccessLevel(),
            null,
            $this->getAccessDeniedMessage()
        );

        $directory = $this->getDoctrine()->getRepository('AppBundle:Directory')->find($id);

        if (is_null($directory)) {
            $directory = $this->getDoctrine()->getRepository('AppBundle:Directory')->findOneBy(
                array('parentDirectory' => null)
            );
        }

        if ($popup == 0) {
            return $this->render(
                ':Filemanager:default/list.html.twig',
                array(
                    'back' => $directory->isRootNode(),
                    'currentDirectory' => $directory,
                )
            );
        } else {
            return $this->render(
                ':Filemanager:popup/list.html.twig',
                array(
                    'back' => $directory->isRootNode(),
                    'currentDirectory' => $directory,
                )
            );
        }
    }

    /**
     * @return string
     */
    protected function getAccessDeniedMessage()
    {
        return $this->get('translator')->trans(
            $this->getTranslationDomain() . '.access_denied',
            array(),
            $this->getTranslationDomain()
        );
    }

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'filemanager';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_ARTICLE';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_ARTICLE';
    }
}
