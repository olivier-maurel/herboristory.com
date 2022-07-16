<?php

namespace App\Form;

use App\Entity\Plant;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('keywords')
            ->add('description', TextareaType::class)
            ->add('image')
            ->add('plant', EntityType::class, [
                'empty_data' => null,
                'required' => false,
                'class' => Plant::class,
                'attr' => [
                    'hidden' => true
                ]
            ])
            ->add('content', PostContentType::class)
        ;

        $builder->get('keywords')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsArray) {
                    return implode(',', $tagsAsArray);
                },
                function ($tagsAsString) {
                    return explode(',', $tagsAsString);
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
