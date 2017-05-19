<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TvShowManagerBundle\Entity\TvShow;
use TvShowManagerBundle\Form\TvShowType;

class TvShowController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tvShows = $em->getRepository('TvShowManagerBundle:TvShow')
            ->findAll();

        return $this->render('@TvShowManager/TvShow/list.html.twig', array(
            'tvShows' => $tvShows,
        ));
    }

    public function addAction(Request $request)
    {
        $tvShow = new TvShow();

        $form = $this->createForm(TvShowType::class, $tvShow);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tvShow);
            $em->flush();

            return $this->redirectToRoute('tv_shows_list');
        }

        return $this->render('@TvShowManager/TvShow/add.html.twig', array(
            'addForm' => $form->createView(),
        ));
    }

    public function editAction(Request $request, $tvShowName)
    {
        $em = $this->getDoctrine()->getManager();
        $tvShow = $em->getRepository('TvShowManagerBundle:TvShow')
            ->findOneByName($tvShowName);

        $form = $this->createForm(TvShowType::class, $tvShow);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('tv_shows_list');
        }

        return $this->render('@TvShowManager/TvShow/edit.html.twig', array(
            'editForm' => $form->createView(),
        ));
    }

    public function deleteAction(Request $request, $tvShowName)
    {
        $em = $this->getDoctrine()->getManager();
        $tvShow = $em->getRepository('TvShowManagerBundle:TvShow')
            ->findOneByName($tvShowName);

        $em->remove($tvShow);
        $em->flush();

        return $this->render('@TvShowManager/TvShow/delete.html.twig', array(
            'show' => $tvShow,
        ));
    }
}
