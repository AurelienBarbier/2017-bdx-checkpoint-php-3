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
        $maxInterval = 0;

        $arrayKey = array_keys($series);
        var_dump($arrayKey);

        for($i=0;$i<count($arrayKey);$i++){
            $date1 = $arrayKey[$i];
            if ($i+1<count($arrayKey)){
                $date2 = $arrayKey[$i+1];
                $interval = $date2 - $date1;
                if ($interval>$maxInterval){
                    $maxInterval = $interval;
                }
            }
            else{
                return $maxInterval;
            }
        }
    }

}
