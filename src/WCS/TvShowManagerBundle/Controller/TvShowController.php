<?php

namespace WCS\TvShowManagerBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WCS\TvShowManagerBundle\Entity\TvShow;
use WCS\TvShowManagerBundle\WCSTvShowManagerBundle;

class TvShowController extends Controller
{
    public function listAction()
    {
        $tvShow = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->findAll();

        return $this->render('WCSTvShowManagerBundle:TvShow:list.html.twig', array(
            'tvshows' => $tvShow
        ));
    }

    public function modifAction(Request $request, TvShow $tvShow)
    {
        $form = $this->createForm('WCS\TvShowManagerBundle\Form\TvShowType', $tvShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'La série '.$tvShow->getName().' a bien été modifiée'
            );

            return $this->redirectToRoute('tvshow_list');
        }

        return $this->render('WCSTvShowManagerBundle:TvShow:modif.html.twig', array(
            'tvshow' => $tvShow,
            'form' => $form->createView(),
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tvShow = new TvShow();
        $form = $this->createForm('WCS\TvShowManagerBundle\Form\TvShowType', $tvShow);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tvShow = $form->getData();
            $em->persist($tvShow);
            $em->flush();

            $this->addFlash(
                'success',
                'La série '.$tvShow->getName().' a bien été ajoutée'
            );

            return $this->redirectToRoute('tvshow_list');
        }

        return $this->render('WCSTvShowManagerBundle:TvShow:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction(TvShow $tvShow)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($tvShow);
        $em->flush();

        $this->addFlash(
            'success',
            'La série '.$tvShow->getName().' a bien été supprimée'
        );

        return $this->redirectToRoute('tvshow_list');
    }

}
