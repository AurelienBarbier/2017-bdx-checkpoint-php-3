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
        uksort($series, function($a, $b){
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });
        $series = array_values(array_flip($series));
        $maxdifference = 0;
        for ($i = 0; $i < count($series)-1; $i++){
            $difference =  $series[$i+1] - $series[$i];
            $maxdifference = $difference > $maxdifference ? $difference : $maxdifference;
        }
        return $maxdifference;
    }

}
