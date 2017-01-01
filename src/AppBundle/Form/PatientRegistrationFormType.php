<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 29/12/16 03:11 PM
 *
 */

namespace AppBundle\Form;


use AppBundle\Entity\Patient;
use Nelmio\Alice\support\extensions\CustomProcessor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PatientRegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // User Properties
            ->add('username')
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('gender', ChoiceType::class, [
                'hombre',
                'mujer',
                'otro'
            ])->add('birthDate', DateType::class)
            ->add('address')
            ->add('phoneNumber', NumberType::class)
            // Patient Type
            ->add('curp')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
            'validation_groups' => ['Default', 'Registration']
        ]);
    }
}
