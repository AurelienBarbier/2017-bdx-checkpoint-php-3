<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TvShowManagerBundle\Entity\Episode;
use TvShowManagerBundle\Form\EpisodeType;

class EpisodeController extends Controller
{

    public function addAction()
    {
        // Je cree un nouvel objet Episode
        $episode = new Episode();
        // Je cree un nouvel objet Formulaire Episode, avec en param mon objet episode
        $form = $this->createForm(EpisodeType::class, $episode);

        // J'hydrate mon formulaire avec les donnees soumises par l'utilisateur.
        $form->handleRequest($request);

        // Je teste si le formulaire est soumis et Valid
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Je persiste
            $em->persist($episode);
            // Et demande d'executer mon enregistrement en base.
            $em->flush();
            //tout s'est bien passe, je retourne sur la page d'affichage de ma serie.
            return $this->redirectToRoute('episode_manager_show', ['id' => $episode->getId() ]);
        }

        return $this->render('TvShowManagerBundle:Episode:add.html.twig',
            [
                'episode_form' => $form->createView(),
            ]      
            );
    }

    /**
     *  @var int $id
     *
     *  Page d'affichage d'un episode
     **/
    public function showAction($id)
    {

        // On cree notre entity manager, afin d'utiliser la BDD
        $em = $this->getDoctrine()->getEntityManager();
        // Je recupere TOUTES mes series.
        $episode = $em->getRepository('TvShowManagerBundle:Episode')->find($id);
        // Je renvois la vue twig de la page d'accueil avec en param ma lsite de series
        return $this->render('TvShowManagerBundle:Episode:show.html.twig',
            [
            'episode' => $episode,
            ]);
    }

    public function editAction($id, Request $request)
    {
        // On cree notre entity manager, afin d'utiliser la BDD
        $em = $this->getDoctrine()->getEntityManager();
        // Je recupere TOUTES mes series.
        $episode = $em->getRepository('TvShowManagerBundle:Episode')->find($id);
        // Je cree un nouvel objet Formulaire Episode, avec en param mon objet episode
        $form = $this->createForm(EpisodeType::class, $episode);

        // J'hydrate mon formulaire avec les donnees soumises par l'utilisateur.
        $form->handleRequest($request);

        // Je teste si le formulaire est soumis et Valid
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Je persiste
            $em->persist($episode);
            // Et demande d'executer mon enregistrement en base.
            $em->flush();
            //tout s'est bien passe, je retourne sur la page d'affichage de ma serie.
            return $this->redirectToRoute('episode_manager_show', ['id' => $episode->getId() ]);
        }

        return $this->render('TvShowManagerBundle:Episode:edit.html.twig',
            [
            'episode_form' => $form->createView(),
            ]      
            );
    }
    
    public function deleteAction()
    {
        return $this->redirectToRoute('tv_show_manager_homepage');
    }
}
