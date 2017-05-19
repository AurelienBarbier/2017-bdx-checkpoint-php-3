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

    	$a_keys = array_keys($series);
    	sort($a_keys, SORT_NUMERIC);
    	print_r($a_keys);

    	$a_diff = array();

    	for ($i = 0; $i < count($a_keys)-1; $i++){
    		  			
    		if($a_keys[$i +1]){ 
    			$diff = abs(abs($a_keys[$i])-abs($a_keys[$i +1]));
    		
    		array_push($a_diff, $diff);
    		
    		}
    	}
    	return (max($a_diff));

    }

}
