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
                'choices' => [
                    'Part 1' => 1,
                    'Part 2' => 2,
                ],
            ])
            ->add('input_type', ChoiceType::class, [
                'choices' => [
                    'Preview'  => 'preview',
                    'Input' => 'input',
                ],
                'expanded' => true,
            ])
            ->add('input', TextareaType::class, [
                'required'   => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Get result',
                'attr' => ['class' => 'text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2'],
            ])
        ;
        $builder->setData(array(
            'input_type' => 'preview',
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
