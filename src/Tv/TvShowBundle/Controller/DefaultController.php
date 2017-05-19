<?php

namespace Tv\TvShowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TvTvShowBundle:Default:index.html.twig');
    }
}
