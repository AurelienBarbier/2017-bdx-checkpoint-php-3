<?php

namespace WCS\TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EpisodeController extends Controller
{
    public function listAction($id)
    {
        $tvshow = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')
            ->findOneBy(
                array('id' => $id)
            );
        $episodes = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')
            ->findBy(
                array('tvshow' => $id));

        return $this->render('WCSTvShowManagerBundle:Episode:list.html.twig', array(
            'tvshow' => $tvshow,
            'episodes' => $episodes
        ));
    }

    public function modifAction()
    {
        return $this->render('WCSTvShowManagerBundle:Episode:modif.html.twig', array(
            // ...
        ));
    }

    public function addAction()
    {
        return $this->render('WCSTvShowManagerBundle:Episode:add.html.twig', array(
            // ...
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $episode = $em->getRepository('WCSTvShowManagerBundle:Episode')
            ->findOneBy(array('id' => $id));

        $em->remove($episode);
        $em->flush();

        return $this->redirectToRoute('tvshow_list');
    }

}
