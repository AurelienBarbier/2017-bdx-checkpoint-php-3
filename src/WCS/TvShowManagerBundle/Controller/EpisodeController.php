<?php

namespace WCS\EpisodeManagerBundle\Controller;

use WCS\TvShowManagerBundle\Entity\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Episode controller.
 *
 */
class EpisodeController extends Controller
{
    /**
     * Lists all episode entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $episode = $em->getRepository('WCSEpisodeManager:Episode')->findAll();

        return $this->render('', array(
            'episode' => $episode,
        ));
    }

    /**
     * Creates a new episode entity.
     *
     */
    public function newAction(Request $request)
    {
        $episode = new Episode();
        $form = $this->createForm('WCS\TvShowManager\Form\EpisodeType', $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($episode);
            $em->flush();

            return $this->redirectToRoute('episode_index', array('id' => $episode->getId()));
        }

        return $this->render('new.html.twig', array(
            'episode' => $episode,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a episode entity.
     *
     */
    public function showAction(Episode $episode)
    {
        $deleteForm = $this->createDeleteForm($episode);

        return $this->render('show.html.twig', array(
            'episode' => $episode,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Episode entity.
     *
     */
    public function editAction(Request $request, Episode $episode)
    {
        $deleteForm = $this->createDeleteForm($episode);
        $editForm = $this->createForm('WCS\TvShowManager\Form\EpisodeType', $episode);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('episode_edit', array('id' => $episode->getId()));
        }

        return $this->render('edit.html.twig', array(
            'episode' => $episode,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a episode entity.
     *
     */
    public function deleteAction(Request $request, Episode $episode)
    {
        $form = $this->createDeleteForm($episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($episode);
            $em->flush();
        }

        return $this->redirectToRoute('episode_index:');
    }


}
