<?php

namespace TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use TvShowManagerBundle\Entity\TvShow;

class TvShowController extends Controller
{
    public function addAction( )
    {
        $tvShow = new TvShow();

        $formBuilder = $this->createFormBuilder($tvShow);

        $formBuilder
            ->add('name', TextType::class)
            ->add('type', TextType::class)
            ->add('url', TextType::class)
            ->add('year', IntegerType::class)
            ->add('submit', SubmitType::class);

        $form = $formBuilder->getForm();
        return $this->render('TvShowManagerBundle:Default:add.html.twig', array('my_form' => $form->createView()
        ));
    }
    public function editAction()
    {
        $tvShow = new TvShow();

        $formBuilder = $this->createFormBuilder($tvShow);

        $formBuilder
            ->add('name', TextType::class)
            ->add('type', TextType::class)
            ->add('url', TextType::class)
            ->add('year', IntegerType::class)
            ->add('submit', SubmitType::class);

        $form = $formBuilder->getForm();
        return $this->render('TvShowManagerBundle:Default:edit.html.twig', array('my_form' => $form->createView()
        ));
    }
}