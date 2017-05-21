<?php

namespace SubjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlgoController extends Controller
{
    //////////////////////////////////////
    // Complète la fonction suivante //
    //////////////////////////////////////

    //En entrée :
        //Un tableau contenant des années (en clé) et des noms de série en valeur. Le tableau n'est pas trié.
    //En sortie:
        //Un entier, réprésentant le plus grand écart de date entre deux séries.

    public function dateInterval ($series) {

        //declaration tab / reprise de l'ex pour tenter de faire qqch!

        $series=[ 2005=>'How I met your mother',
                  1985=>'MacGyver',
                  1994=>'Friends',
                  1997=>'Buffy',
                  2011=>'Game of thrones',
                  1978=>'Dallas',
                ];

        foreach ($series as $serie) //var dans un tab
        {
            $result= $serie.key > $serie.key; // et vive le "je sais que c'est pas ça et je comprends rien"
        }
        return $result;
    } // fin function
} // fin class
