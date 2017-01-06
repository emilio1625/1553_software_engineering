<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 30/12/16 09:26 PM
 *
 */

namespace AppBundle\Form;

use AppBundle\Entity\Appointment;
use AppBundle\Entity\Doctor;
use AppBundle\Entity\Patient;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles = $options['roles'];
        if (in_array('ROLE_DOCTOR', $roles) || in_array('ROLE_ADMIN', $roles)) {
            $builder->add('patient', AutocompleteType::class, [
                'class' => Patient::class
            ]);
        } elseif (in_array('ROLE_PATIENT', $roles) || in_array('ROLE_ADMIN', $roles)) {
            $builder->add('doctor', AutocompleteType::class, [
                'class' => Doctor::class
            ]);
        }
        $builder
            ->add('startsAt', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-appointment-date'
                ]
            ])
            ->add('duration', DateIntervalType::class, [
                'hours' => [
                    1 => 1,
                    2 => 2,
                    3 => 3
                ],
                'with_years' => false,
                'with_months' => false,
                'with_days' => false,
                'with_hours' => true,
            ])
            ->add('notes', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
            'roles' => ['ROLE_PATIENT']
        ]);
    }
}
