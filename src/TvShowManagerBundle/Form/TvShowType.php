<?php

namespace TvShowManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TvShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('name', TextType::class, array(
                'label' => "Nom",
            ))
            ->add('type', TextType::class, array(
                'label' => "Genre",
            ))
            ->add('year', IntegerType::class, array(
                'label' => "Année de création",
            ))
            ->add('url', TextType::class, array(
                'label' => "Url de l'illustration",
            ))
            ->add('submit', SubmitType::class, array(
                'label' => "Valider",
            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'TvShowManagerBundle\Entity\TvShow'
        ));
    }
}