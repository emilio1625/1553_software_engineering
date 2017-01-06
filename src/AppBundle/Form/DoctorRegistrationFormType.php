<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 4/01/17 11:06 PM
 *
 */

namespace AppBundle\Form;

use AppBundle\Entity\Doctor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // User Properties
            ->add('username', TextType::class, [
                'trim' => true
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('email', EmailType::class)
            ->add('gender', ChoiceType::class, [
                'placeholder' => 'Elige un género',
                'expanded' => true, 'multiple' => false, // radio buttons
                'choices' => [
                    'hombre' => 'hombre',
                    'mujer' => 'mujer',
                    'otro' => 'otro'
                ]
            ])->add('birthDate', BirthdayType::class, [
                'widget' => 'single_text'
            ])
            ->add('address')
            ->add('phoneNumber', NumberType::class)
            // Doctor Properties
            ->add('professionalId')
            ->add($child)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
            'validation_groups' => ['Default', 'Registration']
        ]);
    }
}
