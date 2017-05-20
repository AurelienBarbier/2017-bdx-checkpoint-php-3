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

        $arrayDates = array_keys($series);

        for($i=0;$i<count($arrayDates);$i++){
            $currentDate = $arrayDates[$i];
            $nextIteration = $i + 1;
            if ($nextIteration<count($arrayDates)){
                $nextDate = $arrayDates[$nextIteration];
                $interval = $nextDate - $currentDate;
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
