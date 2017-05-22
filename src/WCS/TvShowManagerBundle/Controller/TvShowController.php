<?php

namespace WCS\TvShowManagerBundle\Controller;

use WCS\TvShowManagerBundle\Entity\TvShow;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * TvShow controller.
 *
 */
class TvShowController extends Controller
{
    /**
     * Lists all tv_show entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tv_show = $em->getRepository('WCSTvShowManagerBundle:TvShow')->findAll();

        return $this->render('TvShow/index.html.twig', array(
            'tv_show' => $tv_show,
        ));
    }

    /**
     * Creates a new tv_show entity.
     *
     */
    public function newAction(Request $request)
    {
        $tv_show = new TvShow();
        $form = $this->createForm('WCS\TvShowManagerBundle\Form\TvShowType', $tv_show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tv_show);
            $em->flush();

            return $this->redirectToRoute('tvshow_index', array('id' => $tv_show->getId()));
        }

        return $this->render('TvShow/new.html.twig', array(
            'tv_show' => $tv_show,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tv_show entity.
     *
     */
    public function showAction(TvShow $tv_show)
    {
        $deleteForm = $this->createDeleteForm($tv_show);

        return $this->render('TvShow/show.html.twig', array(
            'tv_show' => $tv_show,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tv_show entity.
     *
     */
    public function editAction(Request $request, TvShow $tv_show)
    {
        $deleteForm = $this->createDeleteForm($tv_show);
        $editForm = $this->createForm('WCS\TvShowManagerBundle\Form\TvShowType', $tv_show);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tvshow_edit', array('id' => $tv_show->getId()));
        }

        return $this->render('TvShow/edit.html.twig', array(
            'tv_show' => $tv_show,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tv_show entity.
     *
     */
    public function deleteAction(Request $request, TvShow $tv_show)
    {
        $form = $this->createDeleteForm($tv_show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tv_show);
            $em->flush();
        }

        return $this->redirectToRoute('tvshow_index');
    }

    /**
     * Creates a form to delete a flight entity.
     *
     * @param TvShow $tv_show The tv_show entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TvShow $tv_show)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tvshow_delete', array('id' => $tv_show->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}

