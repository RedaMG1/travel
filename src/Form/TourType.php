<?php

namespace App\Form;

use App\Entity\Tour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your address',
                    'class' => 'form-control',
                    'id' => 'name'
                ]
            ])
            ->add('price', TextType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your address',
                    'class' => 'form-control',

                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your address',
                    'class' => 'form-control',

                ]
            ])
            ->add('location', TextType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your address',
                    'class' => 'form-control',

                ]
            ])
            ->add('day', NumberType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your address',
                    'class' => 'form-control',

                ]
            ])
            ->add('image', TextType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your address',
                    'class' => 'form-control',

                ]
            ])
            ->add('online')
            ->add('Submit', SubmitType::class, [
                'attr' => [
                    'class' => 'movebtn movebtnsu'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tour::class,
        ]);
    }
}
