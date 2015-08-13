<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    public function createAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $category = $form->getData();
            $this->getCategoryRepository()->save($category);

            return $this->redirectToRoute(
                'intent_backend_category_edit',
                array(
                    'id' => $category->getId(),
                )
            );
        }

        return $this->render(
            ':Category:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id)
    {
        $category = $this->getCategoryRepository()->find($id);

        if (is_null($category)) {
            throw new NotFoundHttpException($this->get('translator')->trans('tag.not_found', array(), 'tag'));
        }

        $form = $this->createForm(new CategoryType(), $category);

        if ($form->isValid()) {
            $category = $form->getData();
            $this->getCategoryRepository()->save($category);

            return $this->redirectToRoute(
                'intent_backend_category_edit',
                array(
                    'id' => $category->getId(),
                )
            );
        }

        return $this->render(
            ':Category:edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Category:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $categories = $this->getCategoryRepository()->findAll();

        return $this->render(
            ':Category:list.html.twig',
            array(
                'categories' => $categories,
            )
        );
    }

    private function getCategoryRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Category');
    }
}
