<?php

namespace TV\TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TVTvShowManagerBundle:Default:index.html.twig');
    }
}
