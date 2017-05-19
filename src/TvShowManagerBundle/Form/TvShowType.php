<?php

namespace TvShowManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

Class TvShowType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Name', TextType::class)
                ->add('Type', TextType::class)
                ->add('Url', TextType::class)
                ->add('Year', IntegerType::class)
        ;

        public function configureOptions(OptionsResolver $resolver) {
            $resolver->setDefault(array(
                'data_class' => 'TvShowManagerBundle\Form\TvShow'
            ));
        }
    }
}

?>