<?php

namespace WCS\TvShowManagerBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use WCS\TvShowManagerBundle\Entity\TvShow;
use WCS\TvShowManagerBundle\WCSTvShowManagerBundle;

class TvShowController extends Controller
{
    public function listAction()
    {
        $tvShow = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->findTvShowByNote();

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

    public function dqlAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('list', ChoiceType::class, array(
                'label' => 'Choix requête',
                'choices' => array(
                    "Liste tous les episodes d'une série" => 'findAllEpisodeBySerie',
                    'Nombre total épisodes' => 'findNbEpisode',
                    'Episode le moins bien noté' => 'findWorstEpisode',
                    "Episode le mieux noté d'une série" => 'findBestEpisodeBySerie',
                    'Les 3 pires séries' => 'findThreeWorstSerie',
                    'Les 3 meilleurs episodes' => 'findThreeBestEpisode',
                    "Serie ayant le plus d'épisodes" => 'findSerieByMoreEpisode',
                    'Séries sorties avant 2000' => 'findSerieByYearBefore2000',
                    "Toutes les séries avec nombre d'épisodes par saison" => 'findAllSerieWithNbEpisodeBySeason',
                    "Toutes les séries avec la note moyenne par saison" => 'findAllSerieWithNoteBySeason'
                )
            ))
            ->add('tvshow', EntityType::class, array(
                'label' => 'Nom de la série',
                'class' => 'WCSTvShowManagerBundle:TvShow',
                'choice_label' => 'name'
            ))
            ->add('save', SubmitType::class, array('label' => 'Rechercher'))
            ->getForm();

        switch ($request->request->get('form')['list']) {
            case 'findAllEpisodeBySerie':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->DQLfindAllEpisodeBySerie($request->request->get('form')['tvshow']);
                break;
            case 'findNbEpisode':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->DQLfindNbEpisode();
                break;
            case 'findWorstEpisode':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->DQLfindWorstEpisode();
                break;
            case 'findBestEpisodeBySerie':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->DQLfindBestEpisodeBySerie($request->request->get('form')['tvshow']);
                break;
            case 'findThreeWorstSerie':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->DQLfindThreeWorstSerie();
                break;
            case 'findThreeBestEpisode':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->DQLfindThreeBestEpisode();
                break;
            case 'findSerieByMoreEpisode':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->DQLfindSerieByMoreEpisode();
                break;
            case 'findSerieByYearBefore2000':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->DQLfindSerieByYearBefore2000();
                break;
            case 'findAllSerieWithNbEpisodeBySeason':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->DQLfindAllSerieWithNbEpisodeBySeason();
                break;
            case 'findAllSerieWithNoteBySeason':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->DQLfindAllSerieWithNoteBySeason();
                break;
            default:
                $result = null;

        }

        return $this->render('WCSTvShowManagerBundle:TvShow:listdql.html.twig', array(
            'form' => $form->createView(),
            'result' => $result
        ));

    }

    public function queryBuilderAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('list', ChoiceType::class, array(
                'label' => 'Choix requête',
                'choices' => array(
                    "Liste tous les episodes d'une série" => 'findAllEpisodeBySerie',
                    'Nombre total épisodes' => 'findNbEpisode',
                    'Episode le moins bien noté' => 'findWorstEpisode',
                    "Episode le mieux noté d'une série" => 'findBestEpisodeBySerie',
                    'Les 3 pires séries' => 'findThreeWorstSerie',
                    'Les 3 meilleurs episodes' => 'findThreeBestEpisode',
                    "Serie ayant le plus d'épisodes" => 'findSerieByMoreEpisode',
                    'Séries sorties avant 2000' => 'findSerieByYearBefore2000',
                    "Toutes les séries avec nombre d'épisodes par saison" => 'findAllSerieWithNbEpisodeBySeason',
                    "Toutes les séries avec la note moyenne par saison" => 'findAllSerieWithNoteBySeason'
                )
            ))
            ->add('tvshow', EntityType::class, array(
                'label' => 'Nom de la série',
                'class' => 'WCSTvShowManagerBundle:TvShow',
                'choice_label' => 'name'
            ))
            ->add('save', SubmitType::class, array('label' => 'Rechercher'))
            ->getForm();

        switch ($request->request->get('form')['list']) {
            case 'findAllEpisodeBySerie':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->QBfindAllEpisodeBySerie($request->request->get('form')['tvshow']);
                break;
            case 'findNbEpisode':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->QBfindNbEpisode();
                break;
            case 'findWorstEpisode':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->QBfindWorstEpisode();
                break;
            case 'findBestEpisodeBySerie':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->QBfindBestEpisodeBySerie($request->request->get('form')['tvshow']);
                break;
            case 'findThreeWorstSerie':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->QBfindThreeWorstSerie();
                break;
            case 'findThreeBestEpisode':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:Episode')->QBfindThreeBestEpisode();
                break;
            case 'findSerieByMoreEpisode':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->QBfindSerieByMoreEpisode();
                break;
            case 'findSerieByYearBefore2000':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->QBfindSerieByYearBefore2000();
                break;
            case 'findAllSerieWithNbEpisodeBySeason':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->QBfindAllSerieWithNbEpisodeBySeason();
                break;
            case 'findAllSerieWithNoteBySeason':
                $result = $this->getDoctrine()->getRepository('WCSTvShowManagerBundle:TvShow')->QBfindAllSerieWithNoteBySeason();
                break;
            default:
                $result = null;

        }

        return $this->render('WCSTvShowManagerBundle:TvShow:listqb.html.twig', array(
            'form' => $form->createView(),
            'result' => $result
        ));
    }
}
