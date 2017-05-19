<?php
namespace WCS\TvShowManagerBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use WCS\TvShowManagerBundle\Entity\Episode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('season', IntegerType::class, array(
            'label' => 'Season number :'
        ));
        $builder->add('number', IntegerType::class, array(
            'label' => 'Episode Number :'
        ));
        $builder->add('save', SubmitType::class, array('label' => 'Send'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Episode::class,
        ));
    }
}