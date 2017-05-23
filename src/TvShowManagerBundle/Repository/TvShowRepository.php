<?php

namespace TvShowManagerBundle\Repository;

use Doctrine\Common\Persistence\ObjectManager;
/**
 * TvShowRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TvShowRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	 *
	 */
	public function findByNotes(){

		$query = $this->createQueryBuilder('t')
		->addSelect('AVG(e.note) AS HIDDEN votes')
		->join('t.episodes', 'e')
		->orderBy('votes', 'DESC')
		->groupBy('e.tvShow')
		->getQuery();	

		$result = $query->getResult();

		return $result;
	}
}
