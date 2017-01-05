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
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if ($options['isDoctor']) {
            $builder->add('patient', AutocompleteType::class, [
                'class' => Patient::class
            ]);
        } else {
            $builder->add('doctor', AutocompleteType::class, [
                'class' => Doctor::class
            ]);
        }
        $builder
            ->add('startsAt', DateTimeType::class)
            ->add('finishesAt', DateTimeType::class)
            ->add('notes', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
            'isDoctor' => false
        ]);
    }
}
