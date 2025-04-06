<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day_part', ChoiceType::class, [
                'label_attr' => ['class'=> 'no-display'],
                'choices' => [
                    'Part 1' => 1,
                    'Part 2' => 2,
                ],
                'attr' => ['class' => '']
            ])
            ->add('input', TextareaType::class, [
                'required'   => false,
                'label_attr' => ['class'=> 'no-display'],
                'attr' => [
                    'class' => '',
                    'rows' => 10,
                    'placeholder' => 'Put your input here...',
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Get result',
                'attr' => ['class' => 'submit-button'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
