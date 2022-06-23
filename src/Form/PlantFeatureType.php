<?php

namespace App\Form;

use App\Entity\PlantAttribute;
use App\Entity\PlantFeature;
use App\Repository\PlantFeatureRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantFeatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('leaf')
            ->add('rod')
            ->add('root')
            ->add('flower')
            ->add('fruct')
            ->add('seed')
            ->add('attributes', null, [
                'expanded' => true,
                'multiple' => true
            ])
            
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlantFeature::class,
        ]);
    }
}
