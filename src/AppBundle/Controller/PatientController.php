<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 30/12/16 08:26 PM
 *
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Patient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Security("is_granted('ROLE_USER')")
 * @Route("/patient")
 */
class PatientController extends Controller
{
    /**
     * @Route("/", name="patient_dashboard")
     */
    public function indexAction()
    {
        /** @var Patient $user */
        $user = $this->getUser();
        return new Response('<!doctype html><html lang="es"><head><meta charset="UTF-8"></head><body>Hola '.$user->getFirstName().' '.$user->getLastName().'</body></html>');
    }

    /**
     * @Route(
           "/search",
           name="search_patient",
           defaults={"_format"="json"},
           condition="request.isXmlHttpRequest()"
       )
     */
    public function searchAction(Request $request)
    {
        $query = $request->query->get('q');
        $patients = $this->getDoctrine()->getRepository(Patient::class)->findNameLike($query);
        return $this->render('search.json.twig', ['results' => $patients]);
    }

    /**
     * @Route(
           "/get/{id}",
           name="get_patient",
           defaults={"_format"="json"},
           condition="request.isXmlHttpRequest()"
       )
     * @Method("GET")
     */
    public function getAction($id = null)
    {
        if (null === $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id)) {
            throw $this->createNotFoundException();
        }
        return $this->json($patient->__toString());
    }
}
