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
                'label_attr' => ['class'=> 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'],
                'choices' => [
                    'Part 1' => 1,
                    'Part 2' => 2,
                ],
            ])
            ->add('input_type', ChoiceType::class, [
                'label_attr' => ['class'=> 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'],
                'choices' => [
                    'Preview'  => 'preview',
                    'Input' => 'input',
                ],
                'attr' => ['class' => 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'],
                'expanded' => true,
            ])
            ->add('input', TextareaType::class, [
                'required'   => false,
                'label_attr' => ['class'=> 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'],
                'attr' => ['class' => 'block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Get result',
                'attr' => ['class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'],
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
