<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TvShowManagerBundle\Entity\Episode;
use TvShowManagerBundle\Entity\TvShow;
use TvShowManagerBundle\Form\EpisodeType;

class EpisodeController extends Controller
{
    public function addAction(Request $request, TvShow $tvShow)
    {
        $episode = new Episode();

        $form = $this->createForm(EpisodeType::class, $episode);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $episode->setTvShow($tvShow);
            $em = $this->getDoctrine()->getManager();
            $em->persist($episode);
            $em->flush();

            return $this->redirectToRoute('tv_shows_show', array(
                'name' => $tvShow->getName(),
            ));
        }

        return $this->render('@TvShowManager/Episode/add.html.twig', array(
            'addForm' => $form->createView(),
        ));
    }

    public function editAction(Request $request, Episode $episode)
    {
        $form = $this->createForm(EpisodeType::class, $episode);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('tv_shows_show', array(
                'name' => $episode->getTvShow()->getName(),
            ));
        }

        return $this->render('@TvShowManager/Episode/edit.html.twig', array(
            'editForm' => $form->createView(),
        ));
    }

    public function deleteAction(Request $request, Episode $episode)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($episode);
        $em->flush();

        return $this->render('@TvShowManager/Episode/delete.html.twig', array(
            'episode' => $episode,
        ));
    }
}
