<?php

namespace SubjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlgoController extends Controller
{
    //////////////////////////////////////
    // Complète la fonction suivante //
    //////////////////////////////////////
    //

    public function dateInterval($series)
    {
        ksort($series);
        $clefs = array_keys($series);
        print_r($clefs);
        $maxint = 0;
            for ($i = 0; $i < count($clefs); $i++) {
                if ($i+1 < count($clefs)) {
                    $interval = $clefs[$i+1] - $clefs[$i];
                        if($interval > $maxint) {
                            $maxint = $interval;
                    }
            }
        }
        return($maxint);
    }
}
