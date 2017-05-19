<?php

namespace TvShowManagerBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TvShowManagerBundle\Entity\TvShow;

class EpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('name', TextType::class, array(
                'label' => "Nom",
                'attr' => array('class' => 'form-control'),
            ))
            ->add('tvShow', EntityType::class, array(
                'class' => TvShow::class,
                'choice_label' => 'name',
                'attr' => array('class' => 'form-control'),
            ))
            ->add('season', IntegerType::class, array(
                'label' => "Saison",
                'attr' => array('class' => 'form-control'),
            ))
            ->add('number', IntegerType::class, array(
                'label' => "Numéro",
                'attr' => array('class' => 'form-control'),
            ))
            ->add('note', IntegerType::class, array(
                'label' => "Note",
                'scale' => 0,
                'attr' => array('class' => 'form-control'),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => "Valider",
                'attr' => array('class' => 'form-control'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'TvShowManagerBundle\Entity\Episode'
        ));
    }
}