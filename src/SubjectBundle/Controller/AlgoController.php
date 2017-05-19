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

        $series = [
            2005=>'How I met your mother',
            1985=>'MacGyver',
            1994=>'Friends',
            1997=>'Buffy',
            2011=>'Game of thrones',
            1978=>'Dallas',
        ];
//        ksort($series);
//        for ($i=0, $i< count($series), $i++){
//            echo $series . 'Value' . ' ';
//        $results = [];
//
//        foreach($series as $key1=>$value1) {
//            foreach($series as $key2=>$value2) {
//                $diff =  ($key1 - $key2) . ' ';
////                echo $diff;
//                if ($diff > 0) {
//                    array_push($results, $diff);
//                }
            }
//
//        }
//        sort($results);
////        foreach ($results as $key=>$value){
////            echo $value . 'Value' . ' ';
//        }
//    }

}
