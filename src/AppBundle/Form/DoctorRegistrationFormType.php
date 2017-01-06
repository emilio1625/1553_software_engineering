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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email', EmailType::class)
            // User Properties
            ->add('username', TextType::class, [
                'trim' => true
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class
            ])
            ->add('birthDate', BirthdayType::class, [
                'widget' => 'single_text'
            ])
            ->add('gender', ChoiceType::class, [
                'placeholder' => 'Elige un género',
                'expanded' => true, 'multiple' => false, // radio buttons
                'choices' => [
                    'hombre' => 'hombre',
                    'mujer' => 'mujer',
                    'otro' => 'otro'
                ]
            ])
            ->add('address')
            ->add('phoneNumber', NumberType::class)
            // Doctor Properties
            ->add('professionalId')
            ->add('specialty')
            ->add('dayOff', ChoiceType::class, [
                'choices' => [
                    'sábado' => 'sábado',
                    'domingo' => 'domingo'
                ]
            ])
            ->add('checkInTime', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'single_text'
            ])
            ->add('workHours', ChoiceType::class, [
                'choices' => [
                    ' 5 horas' => new \DateInterval('PT5H'),
                    ' 6 horas' => new \DateInterval('PT6H'),
                    ' 7 horas' => new \DateInterval('PT7H'),
                    ' 8 horas' => new \DateInterval('PT8H'),
                    ' 9 horas' => new \DateInterval('PT9H'),
                    '10 horas' => new \DateInterval('PT10H'),
                ]
            ])
            ->add('breakTime', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'single_text'
            ])
            ->add('breakDuration', ChoiceType::class, [
                'choices' => [
                    '30 minutos' => new \DateInterval('PT30M'),
                    ' 1 hora' => new \DateInterval('PT1H'),
                    ' 1 hora 30 minutos' => new \DateInterval('PT1H30M'),
                    ' 2 horas' => new \DateInterval('PT2H')
                ]
            ])
            ->add('semblance', TextareaType::class)
            ->add('photo', FileType::class)
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
