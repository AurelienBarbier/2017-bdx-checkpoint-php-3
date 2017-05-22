<?php

namespace WCS\TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WCS\TvShowManagerBundle\Entity\Episode;
use WCS\TvShowManagerBundle\Entity\TvShow;
use WCS\TvShowManagerBundle\Form\Type\EpisodeType;
use WCS\TvShowManagerBundle\Form\Type\TvShowType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WCSTvShowManagerBundle:Default:index.html.twig');
    }
    public function tvShowAction(Request $request){

        $tvShow = new TvShow();
        $form = $this->createForm(TvShowType::class, $tvShow);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tvshowform = $form->getData();
            foreach ($tvshowform->getEpisodes() as $episode){
                $episode->setNote(0);
                $episode->settvShow($tvshowform);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($tvshowform);
            $em->flush();
        }

        $em = $this->getDoctrine()->getManager();
        $tvShows = $em->getRepository('WCSTvShowManagerBundle:TvShow')
            ->findBy(array(), array('id' => 'desc'));
        return $this->render('WCSTvShowManagerBundle:Default:tvShow.html.twig', array('tvShows' => $tvShows, 'form' => $form->createView()));
    }
    public function episodeAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $tvshow = $em->getRepository('WCSTvShowManagerBundle:TvShow')
            ->find($id);
        $episodes = $em->getRepository('WCSTvShowManagerBundle:Episode')
            ->findBytvShow($tvshow, array('season'=> 'desc', 'number' => 'desc'));

        $episode = new Episode();
        $form = $this->createForm(EpisodeType::class, $episode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $episodeform = $form->getData();
            $episodeform->settvShow($tvshow);
            $episodeform->setnote(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($episodeform);
            $em->flush();
        }

        return $this->render('WCSTvShowManagerBundle:Default:episode.html.twig', array('episodes' => $episodes, 'form' => $form->createView()));
    }
    public function deleteAction($id = -1){
        if ($id == -1){
            return $this->render('WCSTvShowManagerBundle:Default:index.html.twig');
        }
        $em = $this->getDoctrine()->getManager();
        $tvshow = $em->getRepository('WCSTvShowManagerBundle:TvShow')
            ->find($id);
        $em->remove($tvshow);
        $em->flush();
        return $this->render('WCSTvShowManagerBundle:Default:index.html.twig');
    }
    public function notesAction($id = -1){
        $em = $this->getDoctrine()->getManager();
        $tvShows = $em->getRepository('WCSTvShowManagerBundle:TvShow')
            ->findAllSortedByNotes();
        return $this->render('WCSTvShowManagerBundle:Default:notes.html.twig', array('tvShows' => $tvShows));

    }
}
