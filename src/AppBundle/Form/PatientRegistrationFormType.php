<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 29/12/16 03:11 PM
 *
 */

namespace AppBundle\Form;


use AppBundle\Entity\Patient;
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


class PatientRegistrationFormType extends AbstractType
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
            // Patient Properties
            ->add('curp', TextType::class, [
                'attr' => ['oninput' => 'validarInput(this)'] // for js curp validation
            ])
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
