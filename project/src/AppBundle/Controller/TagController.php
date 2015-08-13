<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use AppBundle\Form\Type\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagController extends Controller
{
    public function createAction(Request $request)
    {
        $tag = new Tag();

        $form = $this->createForm(new TagType(), $tag);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $tag = $form->getData();
            $this->getTagRepository()->save($tag);

            return $this->redirectToRoute(
                'intent_backend_tag_edit',
                array(
                    'id' => $tag->getId(),
                )
            );
        }

        return $this->render(
            ':Tag:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    public function editAction($id)
    {
        $tag = $this->getTagRepository()->find($id);

        if (is_null($tag)) {
            throw new NotFoundHttpException($this->get('translator')->trans('tag.not_found', array(), 'tag'));
        }

        $form = $this->createForm(new TagType(), $tag);

        if ($form->isValid()) {
            $tag = $form->getData();
            $this->getTagRepository()->save($tag);

            return $this->redirectToRoute(
                'intent_backend_tag_edit',
                array(
                    'id' => $tag->getId(),
                )
            );
        }

        return $this->render(
            ':Tag:edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function showAction($id)
    {
        return $this->render(
            ':Tag:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Tag:delete.html.twig',
            array(// ...
            )
        );
    }

    public function listAction($type = null, $page)
    {
        $tags = $this->getTagRepository()->findAll();

        return $this->render(
            ':Tag:list.html.twig',
            array(
                'tags' => $tags,
            )
        );
    }

    private function getTagRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Tag');
    }

}
