<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TvShowManagerBundle\Entity\TvShow;
use TvShowManagerBundle\Form\TvShowType;


use Symfony\Component\HttpFoundation\Request;


class TvShowController extends Controller
{

	/**
	 *	On liste les series teles
	 *
	 */
	public function indexAction()
	{

		$em = $this->getDoctrine()->getManager();
		$tvShows = $em->getRepository('TvShowManagerBundle:TvShow')->findAll();

		return $this->render('TvShowManagerBundle:TvShow:index.html.twig',
			array( 'twig_tvShows' => $tvShows)
			);
	}

	/**
	 *
	 *	Affichage des details d'une serie Tele + liste des episodes associes.
	 *
	 */
	public function detailAction(TvShow $tvShow)
	{
		return $this->render('TvShowManagerBundle:TvShow:detail.html.twig',
			['tvShow' => $tvShow, 'hh' => 0]
			);
	}


	/**
	 *
	 *	Ajout d'une serie tele
	 *	
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

		return $this->render('TvShowManagerBundle:TvShow:add.html.twig',
			['tvShow_form' => $form->createView()]
			);		
	}

	/**
	 *
	 *	Edition d'une serie tele
	 */
	public function editAction(TvShow $tvShow, Request $request){

		$form = $this->createForm(TvShowType::class, $tvShow);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){

			$em = $this->getDoctrine()->getManager();
			$em->flush();
			return $this->redirectToRoute('tv_show_manager_detail', ['id' => $tvShow->getId()]);
		}

		return $this->render('TvShowManagerBundle:TvShow:add.html.twig',
			['tvShow_form' => $form->createView()]
			);

	}


	/**
	 *
	 *	Suppression d'une serie tele
	 */
	public function deleteAction(TvShow $tvShow){

		$em = $this->getDoctrine()->getManager();
		$em->remove($tvShow);

			$em->flush();

		return $this->redirectToRoute('tv_show_manager_homepage');
	}
}