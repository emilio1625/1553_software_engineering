<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 2/01/17 05:40 PM
 *
 */

namespace AppBundle\Form;


use AppBundle\Entity\Patient;
use AppBundle\Entity\Treatment;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TreatmentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('patient', AutocompleteType::class, [
                'class' => Patient::class
            ])
            ->add('description', TextareaType::class)
            ->add('comments', TextareaType::class)
            ->add('cost', MoneyType::class, [
                'concurrency' => 'USD'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Treatment::class
        ]);
    }
}
