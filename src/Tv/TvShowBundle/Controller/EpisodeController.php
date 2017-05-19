<?php

namespace Tv\TvShowBundle\Controller;

use Tv\TvShowBundle\Entity\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EpisodeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $episodes = $em->getRepository('TvTvShowBundle:Episode')->findAll();

        return $this->render('episode/index.html.twig', array (
            'episodes' => $episodes,
        ));

    public function newAction(Request $request){
        $episode = new Epsiode();
        $form = $this->createForm('Tv\TvShowBundle\Form\EpisodeType', $episode);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        $em =$this->getDoctrine()->getManager();
        $em->persist($episode);
        $em->flush();

        return $this->redirectToRoute('episode_show', array('id'=>$episode->getId()));
        }

        return $this->render('epsiode/new.html.twig', array(
            'episode' => $episode,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Episode $episode){
        $deleteForm = $this->createDeleteForm($episode);

        return $this->render('episode/show.html.twig', array(
            'episode' => $episode,
            'delete_form' => $deleteForm->createView(),
        ));
    }

        public function editAction(Request $request, Episode $episode)
    {
        $deleteForm = $this->createDeleteForm($episode);
        $editForm = $this->createForm('Tv\TvShowBundle\Form\EpsiodeType', $episode);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('episode_edit', array('id' => $episode->getId()));
        }

        return $this->render('epsiode/edit.html.twig', array(
            'episode' => $episode,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
        public function deleteAction(Request $request, Episode $episode)
    {
        $form = $this->createDeleteForm($episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($episode);
            $em->flush();
        }

        return $this->redirectToRoute('episode_index');
    }

    }
}