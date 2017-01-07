<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 30/12/16 07:05 PM
 *
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Security("is_granted('ROLE_DOCTOR')")
 * @Route("/doctor")
 */
class DoctorController extends Controller
{
    /**
     * @Route("/", name="doctor_dashboard")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('show_patients');
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route(
           "/search",
           name="search_doctor",
           defaults={"_format"="json"},
           condition="request.isXmlHttpRequest()"
       )
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $query = $request->query->get('q');
        $doctors = $this->getDoctrine()->getRepository(Doctor::class)->findNameLike($query);
        return $this->render('search.json.twig', ['results' => $doctors]);
    }

    /**
     * @Route(
           "/get/{id}",
           name="get_doctor",
           defaults={"_format"="json"},
           condition="request.isXmlHttpRequest()"
       )
     * @Method("GET")
     */
    public function getAction($id = null)
    {
        if (null === $doctor = $this->getDoctrine()->getRepository(Doctor::class)->find($id)) {
            throw $this->createNotFoundException();
        }
        return $this->json($doctor->__toString());
    }

    /**
     * @Route("/patients", name="show_patients")
     */
    public function showPatientsAction()
    {
        if (!$this->getUser() instanceof Doctor) {
            $this->addFlash('warning', 'Tu no tienes pacientes, nada que ver ahí');
            return $this->redirectToRoute('homepage');
        }
        return $this->render(':show:showPatients.html.twig');
    }
}
