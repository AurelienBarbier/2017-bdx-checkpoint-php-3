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
        $tbl=array();
        $tblTitre=array();
        $tblI=array();
        $i=0;
        $tblI[0]=0;
        foreach($series as $cle => $valeur)
        {
            $tbl[$i]=$cle;
            if ($i>0){
                $tblI[$i]= $tbl[$i]-$tbl[$i-1] ;
            }
            $tblTitre[$i++]=$valeur;
        }
        echo "fin serie apres tri  i=".$i."\n";
        $tbl=implode($tbl,",");
        $tblTitre=implode($tblTitre,",");
        $lg=count($tblI);
        $tblS=implode($tblI,",");

        $maxi=0;

        for($i=0;$i<$lg;$i++){
            if($tblI[$i]>$maxi){
                $maxi=$tblI[$i];
            }
        }
        return ($maxi);

    }

}
