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
        $editForm = $this->createForm('WCS\TvShowManagerBundle\Form\TvShowType', $$tvShow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tvshow_list');
        }

return $this->render('questions/edit.html.twig', array(
    'question' => $question,
    'edit_form' => $editForm->createView(),
));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tvshow = new TvShow();
        $form = $this->createForm('WCS\TvShowManagerBundle\Form\TvShowType', $tvshow);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tvshow = $form->getData();
            $em->persist($tvshow);
            $em->flush();

            return $this->redirectToRoute('tvshow_list');
        }

        return $this->render('WCSTvShowManagerBundle:TvShow:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tvshow = $em->getRepository('WCSTvShowManagerBundle:TvShow')
            ->findOneBy(array('id' => $id));

        $em->remove($tvshow);
        $em->flush();

        return $this->redirectToRoute('tvshow_list');
    }

}
