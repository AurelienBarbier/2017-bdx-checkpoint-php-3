<?php

namespace SubjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlgoController extends Controller
{
    //////////////////////////////////////
    // Complète la fonction suivante //
    //////////////////////////////////////
    //

	public function dateInterval ($series) {

		// On trie le tableau dans l'ordre chronologique
		ksort($series);
		// On recupere la longueur totale du tableau
		$nbSeries = count($series);
		// J'initialise mon ecar maximum identifie a 0.
		$maxGap = 0;


		// On inverse cles et valeurs pour avoir les dates comme valeurs du tableau 
		// (plus facile a manipuler).
		$series = array_flip($series);

		// En gerant les date en tant qu'objet dates.
		//On peux AUSSI parcourir un tableau avec un while
		while($serie = current($series)){
			
			$d1= \DateTime::createFromFormat('Y', $serie); 
			$nextSerie = next($series);

			if($d2= \DateTime::createFromFormat('Y', $nextSerie)){

				$gap = $d1->diff($d2)->y; 

				if($gap > $maxGap){
					$maxGap = $gap;
				}
			}
		}


		/*/ En gerant les date en temps que valeurs numeriques.	
		// On applati notre tableau, pour n'avoir que des cles numeriques consecutives 0,1,2 etc
		$series = array_values($series);

		//Pour chaques date stockees dans le tableau
		// Pettite subtilite, je ne vais pas jusqu'au bout du tableau, 
		// car je vais comparer l'avant dernier avec le dernier
		for ($i = 0; $i < ($nbSeries-1); $i++ ) {
			//Je recupere l'ecart entre mon element courant, et celui d'apres,
			$gap =	$series[$i+1] - $series[$i];
			//s'il est superieur a celui deja enregistre, je le sauvegarde.
			if($gap > $maxGap){
				$maxGap = $gap;
			}
		}
		//*/


		return $maxGap;

	}

}
