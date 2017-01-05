<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 3/01/17 06:50 PM
 *
 */

namespace AppBundle\Form;

use AppBundle\Entity\Prescription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescriptionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Rx', TextareaType::class)
            ->add('Recomendaciones', TextareaType::class)
            ->add('Notas', TextareaType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prescription::class
        ]);
    }
}
