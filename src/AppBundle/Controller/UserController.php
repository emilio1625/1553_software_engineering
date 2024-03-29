<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 6/01/17 05:24 AM
 *
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Patient;
use AppBundle\Form\DoctorRegistrationFormType;
use AppBundle\Form\PatientRegistrationFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/register", name="patient_register")
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(PatientRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Patient $patient */
            $patient = $form->getData();
            /** @var UploadedFile $photo */
            $photo = $patient->getPhoto();
            $fileName = $patient->getUsername() . '.' . $photo->guessExtension();
            $photo->move($this->getParameter('doctor_photos_directory'), $fileName);
            $patient->setPhoto($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();
            $this->addFlash('success', 'Bienvenido '.$patient->getFirstName());
            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $patient,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main'
                );
        }
        return $this->render(':security:register.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/register/doctor", name="doctor_register")
     */
    public function registerDoctorAction(Request $request)
    {
        $form = $this->createForm(DoctorRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Doctor $doctor */
            $doctor = $form->getData();
            /** @var UploadedFile $photo */
            $photo = $doctor->getPhoto();
            $fileName = $doctor->getUsername() . '.' . $photo->guessExtension();
            $photo->move($this->getParameter('doctor_photos_directory'), $fileName);
            $doctor->setPhoto($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($doctor);
            $em->flush();
            $this->addFlash('success', 'Bienvenido '. $doctor->getFirstName());
            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $doctor,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main'
                );
        }
        return $this->render(':security:register.html.twig', [
            'form' => $form->createView()
        ]);

    }

}
