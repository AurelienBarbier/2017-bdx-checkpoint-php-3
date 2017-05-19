<?php
namespace WCS\TvShowManagerBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use WCS\TvShowManagerBundle\Entity\TvShow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TvShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('type', TextType::class, array(
            'label' => 'Genre'
        ));
        $builder->add('url', TextType::class, array(
            'label' => 'Image URL'
        ));
        $builder->add('year', IntegerType::class, array(
            'label' => 'Year'
        ));
        $builder->add('save', SubmitType::class, array('label' => 'Send'));

        $builder->add('episodes', CollectionType::class, array(
            'entry_type' => EpisodeType::class,
            'allow_add'    => true,
            'label' => ' ',

        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TvShow::class,
        ));

    }
}