<?php

namespace WCS\TvShowManagerBundle\Repository;

/**
 * EpisodeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EpisodeRepository extends \Doctrine\ORM\EntityRepository
{
    public function DQLfindAllEpisodeBySerie($id)
    {
        $query = $this->_em->createQuery(
            'SELECT e FROM WCSTvShowManagerBundle:Episode e WHERE e.tvshow = :id')
            ->setParameter('id', $id);

        return $query->getResult();
    }

    public function QBfindAllEpisodeBySerie($id)
    {
        $query = $this->createQueryBuilder('e')
            ->where('e.tvshow=:id')
            ->setParameter('id', $id);

        return $query->getQuery()->getResult();
    }

    public function DQLfindNbEpisode()
    {
        $query = $this->_em->createQuery(
            'SELECT count(e.id) FROM WCSTvShowManagerBundle:Episode e');

        return $query->getResult();
    }

    public function QBfindNbEpisode()
    {
        $query = $this->createQueryBuilder('e')
            ->select('count(e.id)');

        return $query->getQuery()->getScalarResult();
    }

    public function DQLfindWorstEpisode()
    {
        $query = $this->_em->createQuery(
            'SELECT e FROM WCSTvShowManagerBundle:Episode e ORDER BY e.note ASC')
            ->setMaxResults(1);

        return $query->getResult();
    }

    public function QBfindWorstEpisode()
    {
        $query = $this->createQueryBuilder('e')
            ->orderBy('e.note', 'asc')
            ->setMaxResults(1);

        return $query->getQuery()->getResult();
    }

    public function DQLfindBestEpisodeBySerie($id)
    {
        $query = $this->_em->createQuery(
            'SELECT e FROM WCSTvShowManagerBundle:Episode e WHERE e.tvshow = :id ORDER BY e.note DESC ')
            ->setParameter('id', $id)
            ->setMaxResults(1);

        return $query->getResult();
    }

    public function QBfindBestEpisodeBySerie($id)
    {
        $query = $this->createQueryBuilder('e')
            ->where('e.tvshow = :id')
            ->orderBy('e.note', 'desc')
            ->setParameter('id', $id)
            ->setMaxResults(1);

        return $query->getQuery()->getResult();
    }

    public function DQLfindThreeBestEpisode()
    {
        $query = $this->_em->createQuery(
            'SELECT e, t.name AS nom_serie
                  FROM WCSTvShowManagerBundle:Episode e 
                  LEFT JOIN e.tvshow t
                  ORDER BY e.note DESC')
            ->setMaxResults(3);

        return $query->getResult();
    }

    public function QBfindThreeBestEpisode()
    {
        $query = $this->createQueryBuilder('e')
            ->addSelect('t.name')
            ->leftJoin('e.tvshow', 't')
            ->orderBy('e.note', 'desc')
            ->setMaxResults(3);

        return $query->getQuery()->getResult();
    }
}
