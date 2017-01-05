<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 1/01/17 06:03 PM
 *
 */

namespace AppBundle\Form;


use AppBundle\Entity\MedicalRecord;
use AppBundle\Entity\Odontogram;
use AppBundle\Entity\Treatment;
use AppBundle\Repository\TreatmentRepository;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MedicalRecordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight')
            ->add('height')
            ->add('bloodPreasure')
            ->add('alergies')
            ->add('job')
            ->add('maritalStatus', ChoiceType::class, [
                'choices' => [
                    "Soltero/a",
                    "Casado/a",
                    "Divorciado/a",
                    "Viudo/a"
                ]
            ])
            ->add('religion')
            ->add('isAlcholic')
            ->add('isDrugAddict')
            ->add('hasDiabetes')
            ->add('hasHeartDiseases')
            ->add('hasAsma')
            ->add('hasHearingImpairment')
            ->add('hasEyesightImpairment')
            ->add('hasSpeechIpariment')
            ->add('hasMusculoskeletalDisorders')
            ->add('hasEpilepsy')
            ->add('hasSinusitis')
            ->add('hasPhysicalRestictions')
            ->add('hasKidneyIllness')
            ->add('hasMentalDisorders')
            ->add('hasHypertension')
            ->add('hasArthritis')
            ->add('hasNoseBleeds')
            ->add('hasMenstrualClamps')
            ->add('hasBleedingDisorders')
            ->add('hasIntestinalDisorders')
            ->add('hasEatingDisorders')
            ->add('hasHeadeaches')
            ->add('hasRecentSurgery')
            ->add('observations', TextareaType::class)
            ->add('treatment', EntityType::class, [
                'placeholder' => 'Elige un tratamiento',
                'class' => Treatment::class,
                'query_builder' => function(TreatmentRepository $repo) use ($options) {
                    return $repo->createByPatientQueryBuilder($options['patient']);
                }
            ])
            ->add('newTreatment', TreatmentFormType::class, [
                'required' => false,
                'mapped' => false
            ])
            ->add('odontogram', AutocompleteType::class, [
                'class' => Odontogram::class,
            ])
            $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                if (empty($data['treatment']) && !empty($data['newTreatment']['name'])) {
                    $form->remove('newTreatment');
                    $form->add('newTreatment', TreatmentFormType::class, array(
                        'property_path' => 'treatment',
                    ));
                }
            });
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MedicalRecord::class,
            'patient' => null
        ]);
    }
}
