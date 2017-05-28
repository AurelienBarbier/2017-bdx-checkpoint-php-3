<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TvShowManagerBundle\Entity\Episode;
use TvShowManagerBundle\Entity\TvShow;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TvShowManagerBundle:Default:index.html.twig');
    }

    public function qbAction($num)
    {
        $result = null;
        $em = $this->getDoctrine()->getManager();

        switch ($num) {

            case 1:
                $tvShow = $em->getRepository(TvShow::class)->find(15);

                $result = $em->getRepository(Episode::class)
                    ->findAllEpisodesByTvShowQB($tvShow);
                $consigne = "Affiche la liste de tous les épisode d'une série :";
                break;

            case 2:
                $result = $em->getRepository(Episode::class)
                    ->countAllEpisodesQB();
                $consigne = "Affiche le nombre total d’épisodes contenus en BDD :";
                break;

            case 3:
                $result = $em->getRepository(Episode::class)
                    ->findWorstEpisode();
                $consigne = "Affiche l’épisode le moins bien noté de toute la BDD :";
                break;

            case 4:
                $tvShow = $em->getRepository(TvShow::class)->find(11);

                $result = $em->getRepository(Episode::class)
                    ->findBestEpisodeByTvShow($tvShow);
                $consigne = "Affiche l’épisode le mieux noté d'une série précise :";
                break;

            case 5:
                $result = $em->getRepository(TvShow::class)
                    ->find3WorstTvShows();
                $consigne = "Affiche les 3 pires séries à ne pas regarder :";
                break;

            case 6:
                $result = $em->getRepository(Episode::class)
                    ->find3BestEpisodes();
                $consigne = "Affiche les 3 meilleures épisodes toutes series confondues en indiquant le nom de la serie :";
                break;

            case 7:
                $result = $em->getRepository(TvShow::class)
                    ->findLongestTvShow();
                $consigne = "Affiche la série la plus longue en nombre d’épisodes :";
                break;

            case 8:
                $result = $em->getRepository(TvShow::class)
                    ->findTvShowsByYear(2000);
                $consigne = "Affiche toutes les séries sorties avant 2000 :";
                break;

            case 9:
                $result = $em->getRepository(Episode::class)
                    ->countEpisodesBySeason();
                $consigne = "Affiche toutes les séries avec le nombre total d’épisodes pour chaque saison d'une série :";
                break;

            case 10:
                $result = $em->getRepository(Episode::class)
                    ->avgNoteBySeasonByTvShow();
                $consigne = "Affiche la note moyenne de chaque saison d'une série :";
                break;
        }

        return $this->render('TvShowManagerBundle:Default:qb.html.twig', array(
            'result' => $result,
            'consigne' => $consigne,
        ));
    }
}
