<?php

namespace SubjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlgoController extends Controller
{
    //////////////////////////////////////
    // Complète la fonction suivante //
    //////////////////////////////////////
    //

    public function dateInterval ($series)
    {
        $array_keys = array_keys($series);

        sort($array_keys, SORT_NUMERIC);
        print_r($array_keys);

        $array_diff = array();

        for ($i = 0; $i < count($array_keys) - 1; $i++) {

            if ($array_keys[$i + 1]) {
                $diff = abs(abs($array_keys[$i]) - abs($array_keys[$i + 1]));

                array_push($a_diff, $diff);

            }
        }
        return (max($array_diff));
    }
}
