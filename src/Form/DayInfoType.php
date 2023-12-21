<?php

namespace App\Form;

use App\Entity\DayInfo;
use App\Entity\Tour;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('tour', EntityType::class, [
                'class' => Tour::class,
                'choice_label' => 'id',
            ])
            ->add('Submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DayInfo::class,
        ]);
    }
}
