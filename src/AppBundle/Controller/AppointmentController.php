<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 31/12/16 04:15 PM
 *
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Appointment;
use AppBundle\Entity\Doctor;
use AppBundle\Form\AppointmentFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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
        $appointment = new Appointment();

        $form = $this->createForm(AppointmentFormType::class, $appointment, [
            'method' => 'PUT',
            'isDoctor' => $this->getUser() instanceof Doctor
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());die;
        }

        return $this->render('form/appointment/new.html.twig', [
            'appointment_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_appointment")
     */
    public function editAppointmentAction(Appointment $appointment ,Request $request)
    {
        $form = $this->createForm(AppointmentFormType::class, $appointment, [
            'method' => 'UPDATE',
            'isDoctor' => $this->getUser() instanceof Doctor
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());die;
        }

        return $this->render('form/appointment/edit.html.twig', [
            'appointment_form' => $form->createView()
        ]);
    }
}
