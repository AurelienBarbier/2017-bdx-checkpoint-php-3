<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use TvShowManagerBundle\Entity\TvShow;
use TvShowManagerBundle\Form\TvShowType;

class TvShowController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tvShows = $em->getRepository('TvShowManagerBundle:TvShow')->findAll();
        return $this->render('TvShowManagerBundle:Default:index.html.twig',
            array( 'twig_tvShows' => $tvShows));
    }



    /**
     *	Affichage des details
     */
    public function detailAction(TvShow $tvShow)
    {
        return $this->render('TvShowManagerBundle:Default:detail.html.twig',
            ['tvShow' => $tvShow]
        );
    }



    /**
     *	Ajout
     */
    public function addAction(Request $request){
        $tvShow = new TvShow();
        $form = $this->createForm(TvShowType::class, $tvShow);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($tvShow);
            $em->flush();
            return $this->redirectToRoute('tv_show_manager_detail', ['id' => $tvShow->getId()]);
        }
        return $this->render('TvShowManagerBundle:Default:add.html.twig',
            ['tvShow_form' => $form->createView()]
        );
    }



    /**
     *	Edition
     */
    public function editAction(TvShow $tvShow, Request $request){
        $form = $this->createForm(TvShowType::class, $tvShow);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('tv_show_manager_detail', ['id' => $tvShow->getId()]);
        }
        return $this->render('TvShowManagerBundle:Default:add.html.twig',
            ['tvShow_form' => $form->createView()]
        );
    }



}
