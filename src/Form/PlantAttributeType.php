<?php

namespace App\Form;

use App\Entity\PlantAttribute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantAttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Couleur' => 'COLOR',
                    'Saison' => 'SEASON',
                    'Habitat' => 'HABITAT'
                ]
            ])
            ->add('label')
            ->add('icon')
            ->add('value')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlantAttribute::class,
        ]);
    }
}
