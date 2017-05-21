<?php

namespace Tv\TvShowBundle\Controller;

use Tv\TvShowBundle\Entity\TvShow;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TvShowController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tvShows = $em->getRepository('TvTvShowBundle:TvShow')->findAll();

        return $this->render('tvshow/index.html.twig', array(
            'tvShows' => $tvShows,
        ));
    }

    public function newAction(Request $request)
    {
        $tvShow = new TvShow();
        $form = $this->createForm('Tv\TvShowBundle\Form\EpisodeType', $tvShow);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tvShow);
            $em->flush();

            return $this->redirectToRoute('tvShow_show', array('id' => $tvShow->getId()));
        }

        return $this->render('tvShow/new.html.twig', array(
            'tvShow' => $tvShow,
            'form' => $form->createView(),
        ));
    }

    public function showAction(TvShow $tvShow)
    {
        $deleteForm = $this->createDeleteForm($tvShow);

        return $this->render('tvShow/show.html.twig', array(
            'tvShow' => $tvShow,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, TvShow $tvShow)
    {
        $deleteForm = $this->createDeleteForm($tvShow);
        $editForm = $this->createForm('Tv\TvShowBundle\Form\TvShowType', $tvShow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tvShow_edit', array('id' => $tvShow->getId()));
        }

        return $this->render('tvShow/edit.html.twig', array(
            'tvShow' => $tvShow,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, TvShow $tvShow)
    {
        $form = $this->createDeleteForm($tvShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tvShow);
            $em->flush();
        }

        return $this->redirectToRoute('tvShow_index');
    }

    private function createDeleteForm(TvShow $tvShow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tvShow_delete', array('id' => $tvShow->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

}
