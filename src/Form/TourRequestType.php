<?php

namespace App\Form;

use App\Entity\TourRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your first name',
                    'class' => 'form-control',
                    'id' => 'name'
                ]
            ])
            ->add('last_name', TextType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your last name',
                    'class' => 'form-control',
                    'id' => 'name'
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => true,

                'attr' => [
                    'placeholder' => 'Enter your email',
                    'class' => 'form-control',
                    'id' => 'name'
                ]
            ])
            ->add('country')
            ->add('adult')
            ->add('children')
            ->add('date')
            ->add('message')
            ->add('Submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TourRequest::class,
        ]);
    }
}
