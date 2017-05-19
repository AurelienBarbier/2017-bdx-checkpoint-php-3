<?php
namespace WCS\TvShowManagerBundle\Bundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class TvShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('type', TextType::class)
            ->add('url', TextType::class)
            ->add('year', IntegerType::class)
            ->add('episodes', IntegerType::class);
    }
}