<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\FilemanagerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;

class FilemanagerController extends Controller
{
    private $path = 'upload/';

    public function createAction($path = '', Request $request)
    {
        $form = $this->createForm(new FilemanagerType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $directoryName = preg_replace("/[^a-z0-9]+/", "", strtolower($form->getData()['name']));
            $filesystem = new Filesystem();

            $filesystem->mkdir($path.$directoryName);

            return $this->redirect('filemanager_list', array('path' => $path));
        }
        return $this->render(
            ':Filemanager:create.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function listAction($path = '')
    {
        $currentDirectory = $path;
        $path = $this->path.$path;
        $finder = new Finder();
        $finder->directories()->in($path);
        $finder->depth(0);

        $directories = array();

        foreach ($finder as $directory) {
            $directories[$directory->getRelativePathname()] = $path;
        }

        $finder = new Finder();
        $finder->files()->in($path);
        $finder->depth(0);

        $files = array();

        foreach ($finder as $file) {
            $files[$file->getRelativePathname()] = $path;
        }

        if ($this->path != $path) {
            $back = substr($currentDirectory, 0, strripos($currentDirectory, '/'));
            $currentDirectory .= '/';
        } else {
            $back = null;
        }

        return $this->render(
            ':Filemanager:list.html.twig',
            array(
                'directories' => $directories,
                'files' => $files,
                'back' => $back,
                'currentDirectory' => $currentDirectory
            )
        );
    }

}
