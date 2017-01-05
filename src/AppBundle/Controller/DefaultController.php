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
}
