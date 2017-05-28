<?php

namespace TvShowManagerBundle\Repository;

use TvShowManagerBundle\Entity\TvShow;

/**
 * EpisodeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EpisodeRepository extends \Doctrine\ORM\EntityRepository
{
    public function findEpisodesWithShow() {
        $qb = $this->createQueryBuilder('e');

        $qb
            ->join('e.tvShow', 's')
            ->addSelect('s');

        return $qb->getQuery()->getResult();
    }

    // Atelier SQL / DQL / QB - Exercice 1
    public function findAllEpisodesByTvShowQB(TvShow $tvShow) {

        $qb = $this->createQueryBuilder('e')
            ->where('e.tvShow = :tvShow')
            ->setParameter('tvShow', $tvShow)
        ;

        return $qb->getQuery()->getResult();
    }

    // Atelier SQL / DQL / QB - Exercice 2
    public function countAllEpisodesQB() {

        $qb = $this->createQueryBuilder('e');

        $qb->select($qb->expr()->count('e'));

        return $qb->getQuery()->getSingleScalarResult();
    }

    // Atelier SQL / DQL / QB - Exercice 3
    public function findWorstEpisode() {

        $qb = $this->createQueryBuilder('e')
            ->orderBy('e.note')
            ->setMaxResults(1)
        ;

        return $qb->getQuery()->getSingleResult();
    }

    // Atelier SQL / DQL / QB - Exercice 4
    public function findBestEpisodeByTvShow(TvShow $tvShow) {

        $qb = $this->createQueryBuilder('e')
            ->where('e.tvShow = :tvShow')
            ->setParameter('tvShow', $tvShow)
            ->orderBy('e.note', 'DESC')
            ->setMaxResults(1)
        ;

        return $qb->getQuery()->getSingleResult();
    }

    // Atelier SQL / DQL / QB - Exercice 6
    public function find3BestEpisodes() {

        $qb = $this->createQueryBuilder('e')
            ->addSelect('s.name')
            ->join('e.tvShow', 's')
            ->orderBy('e.note', 'DESC')
            ->setMaxResults(3)
        ;

        return $qb->getQuery()->getResult();
    }

    // Atelier SQL / DQL / QB - Exercice 9
    public function countEpisodesBySeason() {

        $qb = $this->createQueryBuilder('e')
            ->select('s.name', 'e.season', 'COUNT(e) AS nb_episodes')
            ->join('e.tvShow', 's')
            ->groupBy('s.name')
            ->addGroupBy('e.season')
        ;

        return $qb->getQuery()->getResult();
    }

    // Atelier SQL / DQL / QB - Exercice 10
    public function avgNoteBySeasonByTvShow() {

        $qb = $this->createQueryBuilder('e')
            ->select('s.name', 'e.season', 'AVG(e.note) AS avg_note')
            ->join('e.tvShow', 's')
            ->groupBy('s.name')
            ->addGroupBy('e.season')
        ;

        return $qb->getQuery()->getResult();
    }

}
