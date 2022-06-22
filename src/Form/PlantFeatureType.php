<?php

namespace App\Form;

use App\Entity\PlantFeature;
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
                'attr' => [
                    'hidden' => true,
                    'id' => null
                ]
            ])
        ;

        // $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            
    
        //     
    
        //     
    
        //     $event->setData($data);
        // });

        $builder->get('attributes')->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                
                foreach ($data as $key => $attr) {
                    $return[$attr->getType()][] = $attr;
                }

                return null;
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlantFeature::class,
        ]);
    }
}
