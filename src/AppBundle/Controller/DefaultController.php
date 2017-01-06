<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 30/12/16 06:51 PM
 *
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('::index.html.twig');
    }

    /**
     * @Route("/Quienes_Somos", name="Alternativepage")
     *  @return \Symfony\Component\HttpFoundation\Response
     */

    public function whoAction()
    {
        return $this->render('::whoweare.html.twig');
    }

/**
 * @Route("/Contacto", name="Contactpage")
 * @return \Symfony\Component\HttpFoundation\Response
*/

    public function contactAction()
    {
        return $this->render('::contact.html.twig');
    }

    /**
     * @Route("/Endodoncia", name="Endopage")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function endodonciaAction()
    {
        return $this->render('::endodoncia.html.twig');
    }

    /**
     * @Route("/Ortodoncia", name="Ortodonciapage")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function ortodonciaAction()
    {
        return $this->render('::ortodoncia.html.twig');
    }

    /**
     * @Route("/Odontopetria", name="Odontopetriapage")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function odontopetriaAction()
    {
        return $this->render('::odontopetria.html.twig');
    }

    /**
     * @Route("/Maxilofacial", name="Maxilopage")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function maxiloAction()
    {
        return $this->render('::maxilo.html.twig');
    }


}

