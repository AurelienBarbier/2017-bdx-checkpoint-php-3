<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TvShowManagerBundle\Entity\Episode;
use TvShowManagerBundle\Form\EpisodeType;

class EpisodeController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $episodes = $em->getRepository('TvShowManagerBundle:Episode')
            ->findEpisodesWithShow();

        return $this->render('@TvShowManager/Episode/list.html.twig', array(
            'episodes' => $episodes,
        ));
    }

    public function addAction(Request $request)
    {
        $episode = new Episode();

        $form = $this->createForm(EpisodeType::class, $episode);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($episode);
            $em->flush();

            return $this->redirectToRoute('episodes_list');
        }

        return $this->render('@TvShowManager/Episode/add.html.twig', array(
            'addForm' => $form->createView(),
        ));
    }

    public function editAction(Request $request, $episodeId)
    {
        $em = $this->getDoctrine()->getManager();
        $episode = $em->getRepository('TvShowManagerBundle:Episode')
            ->find($episodeId);

        $form = $this->createForm(EpisodeType::class, $episode);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('episodes_list');
        }

        return $this->render('@TvShowManager/Episode/edit.html.twig', array(
            'editForm' => $form->createView(),
        ));
    }

    public function deleteAction(Request $request, $episodeId)
    {
        $em = $this->getDoctrine()->getManager();
        $episode = $em->getRepository('TvShowManagerBundle:Episode')
            ->find($episodeId);

        $em->remove($episode);
        $em->flush();

        return $this->render('@TvShowManager/Episode/delete.html.twig', array(
            'episode' => $episode,
        ));
    }
}
