<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 31/12/16 04:15 PM
 *
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Appointment;
use AppBundle\Entity\Doctor;
use AppBundle\Entity\Patient;
use AppBundle\Form\AppointmentFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Security("is_granted('ROLE_USER')")
 * @Route("/appointment")
 */
class AppointmentController extends Controller
{
    /**
     * @Route("/new", name="new_appointment")
     */
    public function newAppointmentAction(Request $request)
    {
        /** @var Admin|Doctor|Patient $user */
        $user = $this->getUser();
        $appointment = new Appointment();
        $appointment->setIsCanceled(false);
        $form = $this->createForm(AppointmentFormType::class, $appointment, [
            'method' => 'PUT',
            'roles' => $user->getRoles()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Appointment $appointment */
            $appointment = $form->getData();

            $flashText = 'Se creó la cita';
            if ($user instanceof Admin) {
                if (!$appointment->getDoctor()->isAvailable($appointment) ||
                            !$appointment->getPatient()->isAvailable($appointment)) {
                    $flashText = 'No se pudo crear la cita' . ' con el doctor ' . $appointment->getDoctor()
                        . ' para el paciente ' . $appointment->getPatient()
                        . ' el ' . $appointment->getStartsAt()->format('d-m-Y H:i') . ', una cita de alguno de ellos'
                        . ' se traslapa, intente otra hora o fecha';
                    $this->addFlash('warning', $flashText);
                    $form = $this->createForm(AppointmentFormType::class, $appointment, [
                        'method' => 'PUT',
                        'roles' => $user->getRoles()
                    ]);
                    return $this->render(':form/appointment:newAppointment.html.twig', [
                        'appointment_form' => $form->createView()
                    ]);
                }
                $flashText .= ' para el paciente ' . $appointment->getPatient()
                    . ' con el doctor ' . $appointment->getDoctor();
                $redirectRoute = 'admin_dashboard';
            } elseif ($user instanceof Doctor) {
                if (!$user->isAvailable($appointment) || !$appointment->getPatient()->isAvailable($appointment)) {
                    $flashText = 'No se pudo crear la cita' . ' para el paciente ' . $appointment->getPatient()
                        . ' el ' . $appointment->getStartsAt()->format('d-m-Y H:i') . ', una cita de alguno de ustedes'
                        . ' se traslapa, intente otra hora o fecha';
                    $this->addFlash('warning', $flashText);
                    $form = $this->createForm(AppointmentFormType::class, $appointment, [
                        'method' => 'PUT',
                        'roles' => $user->getRoles()
                    ]);
                    return $this->render(':form/appointment:newAppointment.html.twig', [
                        'appointment_form' => $form->createView()
                    ]);
                }
                $appointment->setDoctor($user);
                $flashText .= ' para el paciente ' . $appointment->getPatient();
                $redirectRoute = 'doctor_dashboard';
            } elseif ($user instanceof Patient) {
                if (!$user->isAvailable($appointment) || !$appointment->getDoctor()->isAvailable($appointment)) {
                    $flashText = 'No se pudo crear la cita' . ' con el médico ' . $appointment->getDoctor()
                        . ' el ' . $appointment->getStartsAt()->format('d-m-Y H:i') . ', usted o él tiene una cita que'
                        . ' se traslapa, intente otra hora o fecha';
                    $this->addFlash('warning', $flashText);
                    $form = $this->createForm(AppointmentFormType::class, $appointment, [
                        'method' => 'PUT',
                        'roles' => $user->getRoles()
                    ]);
                    return $this->render(':form/appointment:newAppointment.html.twig', [
                        'appointment_form' => $form->createView()
                    ]);
                }
                $appointment->setPatient($user);
                $flashText .= ' con el doctor ' . $appointment->getDoctor();
                $redirectRoute = 'patient_dashboard';
            } else {
                $flashText = 'Usted nunca debió haber estado ahí, es peligroso';
                $this->addFlash('danger', $flashText);
                return $this->redirectToRoute('homepage');
            }
            $flashText .= ' el ' . $appointment->getStartsAt()->format('d-m-Y H:i');

            // Save that appointment
            $em = $this->getDoctrine()->getManager();
            $em->persist($appointment);
            $em->flush();

            $this->addFlash('success', $flashText);
            return $this->redirectToRoute($redirectRoute);
        }

        return $this->render(':form/appointment:newAppointment.html.twig', [
            'appointment_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_appointment")
     */
    public function editAppointmentAction(Appointment $appointment ,Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(AppointmentFormType::class, $appointment, [
            'roles' => $user->getRoles()
        ])->add('isCanceled', CheckboxType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appointment = $form->getData();

            $flashText = 'Se modificó la cita';

            if ($user instanceof Doctor) {
                $appointment->setDoctor($this->getUser());
                $flashText .= ' para el paciente '.$appointment->getPatient();
                $redirectRoute = 'doctor_dashboard';
            } else {
                $appointment->setPatient($user);
                $flashText .= ' con el doctor '.$appointment->getDoctor();
                $redirectRoute = 'patient_dashboard';
            }
            $flashText .= ' el '.$appointment->getStartsAt()->format('d-m-Y H:i');

            // Save that appointment
            $em = $this->getDoctrine()->getManager();
            $em->persist($appointment);
            $em->flush();

            $this->addFlash('success', $flashText);
            return $this->redirectToRoute($redirectRoute);
        }

        return $this->render(':form/appointment:editAppointment.html.twig', [
            'appointment_form' => $form->createView()
        ]);
    }
}
