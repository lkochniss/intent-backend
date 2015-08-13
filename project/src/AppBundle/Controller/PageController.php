<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use AppBundle\Form\Type\PageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    public function createAction(Request $request)
    {
        $page = new Page();

        $form = $this->createForm(new PageType(), $page);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $page = $form->getData();
            $this->getPageRepository()->save($page);

            return $this->redirectToRoute(
                'intent_backend_page_edit',
                array(
                    'id' => $page->getId(),
                )
            );
        }

        return $this->render(
            ':Page:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id)
    {
        $page = $this->getPageRepository()->find($id);

        if (is_null($page)) {
            throw new NotFoundHttpException($this->get('translator')->trans('page.not_found', array(), 'page'));
        }

        $form = $this->createForm(new PageType(), $page);

        if ($form->isValid()) {
            $page = $form->getData();
            $this->getPageRepository()->save($page);

            return $this->redirectToRoute(
                'intent_backend_page_edit',
                array(
                    'id' => $page->getId(),
                )
            );
        }

        return $this->render(
            ':Page:edit.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function showAction($id)
    {
        return $this->render(
            ':Page:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Page:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $pages = $this->getPageRepository()->findAll();

        return $this->render(
            ':Page:list.html.twig',
            array(
                'pages' => $pages,
            )
        );
    }

    private function getPageRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Page');
    }

}
