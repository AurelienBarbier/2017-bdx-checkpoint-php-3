<?php

namespace WCS\TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WCS\TvShowManagerBundle\Entity\Episode;
use WCS\TvShowManagerBundle\Entity\TvShow;

class EpisodeController extends Controller
{
    public function listAction(TvShow $tvShow)
    {
        $episodes = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')
            ->findBy(
                array('tvshow' => $tvShow->getId()));

        return $this->render('WCSTvShowManagerBundle:Episode:list.html.twig', array(
            'tvshow' => $tvShow,
            'episodes' => $episodes
        ));
    }

    public function modifAction(Request $request, Episode $episode)
    {
        $form = $this->createForm('WCS\TvShowManagerBundle\Form\EpisodeType', $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                "L'épisode ".$episode->getName().' a bien été modifié'
            );

            return $this->redirectToRoute('episode_list', array('id' => $episode->getTvshow()->getId()));
        }

        return $this->render('WCSTvShowManagerBundle:Episode:modif.html.twig', array(
            'episode' => $episode,
            'idTvShow' => $episode->getTvshow()->getId(),
            'form' => $form->createView(),
        ));
    }

    public function addAction(Request $request, TvShow $tvShow)
    {
        $em = $this->getDoctrine()->getManager();
        $episode = new Episode();
        $form = $this->createForm('WCS\TvShowManagerBundle\Form\EpisodeType', $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $episode = $form->getData();
            $episode->setTvshow($tvShow);
            $em->persist($episode);
            $em->flush();

            $this->addFlash(
                'success',
                "L'épisode ".$episode->getName().' a bien été ajouté'
            );

            return $this->redirectToRoute('episode_list', array('id' => $tvShow->getId()));
        }

        return $this->render('WCSTvShowManagerBundle:Episode:add.html.twig', array(
            'form' => $form->createView(),
            'idTvShow' => $tvShow->getId()
        ));
    }

    public function deleteAction(Episode $episode)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($episode);
        $em->flush();

        $this->addFlash(
            'success',
            "L'épisode ".$episode->getName().' a bien été supprimé'
        );

        return $this->redirectToRoute('episode_list', array('id' => $episode->getTvshow()->getId()));
    }

}
