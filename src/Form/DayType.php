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
                'label_attr' => ['class'=> 'text-gray-700'],
                'choices' => [
                    'Part 1' => 1,
                    'Part 2' => 2,
                ],
                'attr' => ['class' => 'border block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']
            ])
            ->add('input_type', ChoiceType::class, [
//                'label_attr' => ['class'=> 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'],
                'choices' => [
                    'Preview'  => 'preview',
                    'Input' => 'input',
                ],
//                'attr' => ['class' => 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'],
                'expanded' => true,
            ])
            ->add('input', TextareaType::class, [
                'required'   => false,
                'label_attr' => ['class'=> 'text-gray-700'],
                'attr' => [
                    'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
                    'rows' => 10,
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Get result',
                'attr' => ['class' => 'px-3 md:px-4 py-1 md:py-2 bg-sky-600 border border-sky-600 text-white rounded-lg hover:bg-sky-700'],
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
