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
        ksort($series);
        $year = array_keys($series);
        $diffTab = [];
        for($i=0; $i<count($year)-1; $i++){
            $ecart = $year[$i+1]-$year[$i];
            array_push($diffTab, $ecart);
        }
        return max($diffTab);

        /*$precedent = 0;
        $ecart = 0;
        $diff=0;
        foreach($series as $year=>$show) {
            if($precedent > 0) {
                $diff=$year - $precedent;
                if ($diff > $ecart) {
                    $ecart = $diff;
                }
            }
            $precedent = $year;
        }



            return $ecart;*/

    }

}
