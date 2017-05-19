<?php

namespace WCS\tvshowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WCStvshowBundle:Default:index.html.twig');
    }
}
