<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 1/01/17 05:47 PM
 *
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Admin;
use AppBundle\Entity\Appointment;
use AppBundle\Entity\Doctor;
use AppBundle\Entity\MedicalRecord;
use AppBundle\Entity\Treatment;
use AppBundle\Form\MedicalRecordFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Security("is_granted('ROLE_DOCTOR')")
 * @Route("/medical_record")
 */
class MedicalRecordController extends Controller
{
    /**
     * @Route("/new/{id}", name="new_medical_record")
     */
    public function newMedicalRecordAction(Appointment $appointment, Request $request)
    {
        /** @var Doctor|Admin $user */
        $user = $this->getUser();
        $isAdmin = $user instanceof Admin;
        $em = $this->getDoctrine()->getManager();

        if ($user !== $appointment->getDoctor()) {
            $this->addFlash('warning', 'Esta cita no te corresponde');
            $isAdmin ?
                $this->addFlash('danger', 'El registro médico quedará a nombre del médico, pero se registrará que usted lo genero') : $this->addFlash('info', 'El registro médico quedará registrado con usted');
        }


        $medicalRecord = new MedicalRecord();
        $treatment = new Treatment();

        $form = $this->createForm(MedicalRecordFormType::class, $medicalRecord, [
            'method' => 'PUT',
            'patient' => $appointment->getPatient(),
            'treatment' => $treatment,
            'action' => $this->generateUrl(
                'new_medical_record', [
                'id' => $appointment->getId()
            ])
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());

            $appointment->setFinishedAt(new \DateTime('now'));

            $flashText = 'Se ha guardado el registro médico del paciente ' . $medicalRecord->getPatient();
            $redirectRoute = 'doctor_dashboard';


            // Save that medicalRecord and the appointment
            $em->persist($medicalRecord);
            $em->persist($appointment);
            $em->flush();

            $this->addFlash('success', $flashText);
            return $this->redirectToRoute($redirectRoute);
        }

        $appointment->setStartedAt(new \DateTime());
        $em->persist($appointment);
        $em->flush();

        return $this->render(':form/medicalRecord:newMedicalRecord.html.twig', [
            'medical_record_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_medical_record")
     */
    public function editMedicalRecordAction(MedicalRecord $medicalRecord, Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(MedicalRecordFormType::class, $medicalRecord);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalRecord = $form->getData();

            $flashText = 'Se modificó la cita para el paciente '.$medicalRecord->getPatient();
            $redirectRoute = 'doctor_dashboard';

            // Save that medicalRecord
            $em = $this->getDoctrine()->getManager();
            $em->persist($medicalRecord);
            $em->flush();

            $this->addFlash('success', $flashText);
            return $this->redirectToRoute($redirectRoute);
        }

        return $this->render(':form/medicalRecord:editMedicalRecord.html.twig', [
            'medicalRecord_form' => $form->createView()
        ]);
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route(
           "/search",
           name="search_medical_record",
           defaults={"_format"="json"},
           condition="request.isXmlHttpRequest()"
       )
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $query = $request->query->get('q');
        $medicalRecords = $this->getDoctrine()->getRepository(MedicalRecord::class)->findByPatientLike($query);
        return $this->render('search.json.twig', ['results' => $medicalRecords]);
    }

    /**
     * @Route(
           "/get/{id}",
           name="get_medical_record",
           defaults={"_format"="json"},
           condition="request.isXmlHttpRequest()"
       )
     * @Method("GET")
     */
    public function getAction($id = null)
    {
        if (null === $medicalRecord = $this->getDoctrine()->getRepository(MedicalRecord::class)->find($id)) {
            throw $this->createNotFoundException();
        }
        return $this->json($medicalRecord->__toString());
    }
}
