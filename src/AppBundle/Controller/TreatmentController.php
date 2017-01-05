<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Treatment(s): emilio1625
 * Last Modified: 2/01/17 12:48 PM
 *
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Treatment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/treatment")
 * @Security("is_granted('ROLE_DOCTOR')")
 */
class TreatmentController extends Controller
{
    /**
     * @Route("/search", name="search_treatment", defaults={"_format"="json"})
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $search = $request->query->get('q');
        $treatments = $this->getDoctrine()->getRepository(Treatment::class)->findByNameLike($search);
        return $this->render('::search.json.twig', ['results' => $treatments]);
    }

    /**
     * @Route("/get/{id}", name="get_treatment", defaults={"_format"="json"})
     * @Method("GET")
     */
    public function getAction($id = null)
    {
        if (null === $treatment = $this->getDoctrine()->getRepository(Treatment::class)->find($id)) {
            throw $this->createNotFoundException();
        }
        return $this->json($treatment->getName());
    }

    /**
     * @Route("/new", name="new_treatment")
     * @Method({"GET", "PUT"})
     */
    public function newAction(Request $request)
    {
        $treatment = new Treatment();
        $form = $this->createForm('AppBundle\Form\TreatmentFormType', $treatment, [
            'method' => 'PUT',
            // explicit 'action', otherwise modal form will not work
            'action' => $this->generateUrl('new_treatment'),
        ]);

        if ($form->isSubmitted() && $form->handleRequest($request)->isValid()) {
            $this->getDoctrine()->getRepository(Treatment::class)->add($treatment);
            if ($request->isXmlHttpRequest()) {
                return $this->json([ // this is the response that form.js expects to get
                    'id' => $treatment->getId(),
                    'name' => $treatment->getName(),
                    'type' => 'treatment'
                ]);
            } else {
                $this->addFlash('success', 'Nuevo tratamiento creado.');
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render(':form/treatment:newTreatment.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_treatment")
     * @Method({"GET", "POST"})
     */
    public function editAction(Treatment $treatment, Request $request)
    {
        $form = $this->createForm('AppBundle\Form\TreatmentFormType', $treatment);
        if ($form->isValid() && $form->handleRequest($request)->isValid()) {
            $this->getDoctrine()->getRepository(Treatment::class)->add($treatment);
            $this->addFlash('success', 'Tratamiento actualizado.');
            return $this->redirectToRoute('homepage');
        }

        return $this->render(':form/treatment:editTreatment.html.twig', [
            'treatment' => $treatment,
            'form' => $form->createView()
        ]);
    }
}
