<?php

namespace App\Form;

use App\Entity\PostContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description_page', TextareaType::class)
            ->add('alimental_page', TextareaType::class, [
                'required' => false
            ])
            ->add('medicinal_page', TextareaType::class, [
                'required' => false
            ])
            ->add('agricol_page', TextareaType::class, [
                'required' => false
            ])
            ->add('industrial_page', TextareaType::class, [
                'required' => false
            ])
            ->add('images', null, [
                'required' => false
            ])
            ->add('links')
        ;

        $builder->get('images')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsArray) {
                    return implode(',', $tagsAsArray);
                },
                function ($tagsAsString) {
                    return explode(',', $tagsAsString);
                }
            ))
        ;

        $builder->get('links')
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
            'data_class' => PostContent::class,
        ]);
    }
}
