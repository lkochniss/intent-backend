<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Directory;
use AppBundle\Entity\Image;
use AppBundle\Form\Type\DirectoryType;
use AppBundle\Form\Type\UploadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

class FilemanagerController extends Controller
{
    public function createAction($popup = 0, $id = 0, Request $request)
    {
        $directory = new Directory();
        $parentDirectory = $this->getDoctrine()->getRepository('AppBundle:Directory')->find($id);
        $form = $this->createForm(new DirectoryType(), $directory);
        $form->handleRequest($request);

        if ($form->isValid()) {
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

    public function uploadAction($popup = 0, $id = 0, Request $request)
    {
        $image = new Image();
        $form = $this->createForm(new UploadType(), $image);
        $form->handleRequest($request);

        $directory = $this->getDoctrine()->getRepository('AppBundle:Directory')->find($id);
        if (is_null($directory)) {
            $directory = $this->getDoctrine()->getRepository('AppBundle:Directory')->findOneBy(
                array('parentDirectory' => null)
            );
        }

        if ($form->isValid()) {
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

    public function listAction($popup = 0, $id = 0)
    {
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
}
