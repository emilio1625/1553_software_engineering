<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 3/01/17 06:00 PM
 *
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrescriptionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
