<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TvShowManagerBundle\Entity\TvShow;
use TvShowManagerBundle\Form\TvShowType;

class TvShowController extends Controller
{
    /**
     *  Homepage 
     */
    public function indexAction()
    {
        // On cree notre entity manager, afin d'utiliser la BDD
        $em = $this->getDoctrine()->getEntityManager();
        // Je recupere TOUTES mes series.
        $series = $em->getRepository('TvShowManagerBundle:TvShow')->findAll();
        // Je renvois la vue twig de la page d'accueil avec en param ma lsite de series
        return $this->render('TvShowManagerBundle:TvShow:index.html.twig',
            [
            'series' => $series,
            ]);
    }

    /**
     *  Votes 
     */
    public function votesAction()
    {
        // On cree notre entity manager, afin d'utiliser la BDD
        $em = $this->getDoctrine()->getEntityManager();
        // Je recupere TOUTES mes series.
        $a_series = $em->getRepository('TvShowManagerBundle:TvShow')->findByNotes();
        $series = array();
        foreach ($a_series as $k_serie => $a_serie) {
            $a_serie[0]['avg'] = $a_serie['votes'];
            $series[] = $a_serie[0];
        }
        // Je renvois la vue twig de la page d'accueil avec en param ma lsite de series
        return $this->render('TvShowManagerBundle:TvShow:index.html.twig',
            [
            'series' => $series,
            ]);
    }

    /**
     *  Page d'ajout d'une serie.
     */
    public function addAction(Request $request)
    {
        // Je cree un nouvel objet TvShow
        $tvShow = new TvShow();
        // Je cree un nouvel objet Formulaire TvShow, avec en param mon objet tvShow
        $form = $this->createForm(TvShowType::class, $tvShow);

        // J'hydrate mon formulaire avec les donnees soumises par l'utilisateur.
        $form->handleRequest($request);

        // Je teste si le formulaire est soumis et Valid
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Je persiste
            $em->persist($tvShow);
            // Et demande d'executer mon enregistrement en base.
            $em->flush();
            //tout s'est bien passe, je retourne sur la page d'affichage de ma serie.
            return $this->redirectToRoute('tv_show_manager_show', ['id' => $tvShow->getId() ]);
        }

        return $this->render('TvShowManagerBundle:TvShow:add.html.twig', 
            [
            'tvShow_form' => $form->createView(),
            ]      
            );
    }

    /**
     *  @var int $id
     *
     *  Page d'affichage d'une serie
     **/
    public function showAction($id)
    {
        // On cree notre entity manager, afin d'utiliser la BDD
        $em = $this->getDoctrine()->getEntityManager();
        // Je recupere TOUTES mes series.
        $serie = $em->getRepository('TvShowManagerBundle:TvShow')->find($id);
        // Je renvois la vue twig de la page d'accueil avec en param ma lsite de series
        return $this->render('TvShowManagerBundle:TvShow:show.html.twig',
            [
            'serie' => $serie,
            ]);
    }
    public function editAction(Request $request, $id)
    {
        // On cree notre entity manager, afin d'utiliser la BDD
        $em = $this->getDoctrine()->getEntityManager();
        // Je cree un nouvel objet TvShow
        $tvShow = $em->getRepository('TvShowManagerBundle:TvShow')->find($id);
        // Je cree un nouvel objet Formulaire TvShow, avec en param mon objet tvShow
        $form = $this->createForm(TvShowType::class, $tvShow);

        // J'hydrate mon formulaire avec les donnees soumises par l'utilisateur.
        $form->handleRequest($request);

        // Je teste si le formulaire est soumis et Valid
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Je persiste
            $em->persist($tvShow);
            // Et demande d'executer mon enregistrement en base.
            $em->flush();
            //tout s'est bien passe, je retourne sur la page d'affichage de ma serie.
            return $this->redirectToRoute('tv_show_manager_show', ['id' => $tvShow->getId() ]);
        }

        return $this->render('TvShowManagerBundle:TvShow:edit.html.twig', 
            [
            'tvShow_form' => $form->createView(),
            ]      
            );
    }
    public function deleteAction()
    {

        return $this->redirectToRoute('tv_show_manager_homepage');
    }
}
