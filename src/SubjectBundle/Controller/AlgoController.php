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
        $years = array_keys($series);
        $max_diff = 0;

        for($ind = 0; $ind < sizeof($years) -1; $ind++) {
            $currentDiff = $years[$ind+1]-$years[$ind];
            if ($currentDiff > $max_diff) {
                $max_diff = $currentDiff;
            }
        }

        return $max_diff;
    }

}
