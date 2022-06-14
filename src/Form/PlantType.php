<?php

namespace App\Form;

use App\Entity\Plant;
use App\Entity\PlantFeature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commonName')
            ->add('scientific_class')
            ->add('scientific_order')
            ->add('scientific_family')
            ->add('scientific_genus')
            ->add('scientific_species')
            ->add('iucn_redlist', ChoiceType::class, [
                'choices' => [
                    'LC' => 'LC',
                    'XV' => 'XV',
                    'WO' => 'WO',
                ],
                'expanded' => true
                
            ])
            ->add('similitude', null, [
                'attr' => [
                    'class' => 'select-control'
                ]
            ])
            ->add('feature', PlantFeatureType::class
                // $builder->create('feature', FormType::class)
                //     ->add('leaf')
                //     ->add('rod')
                //     ->add('root')
                //     ->add('flower')
                //     ->add('fruct')
                //     ->add('seed')
                //     ->add('color')
                //     ->add('season')
                //     ->add('habitat')
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plant::class,
        ]);
    }
}
