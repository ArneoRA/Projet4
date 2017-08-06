<?php

namespace Louvre\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('LouvreBookingBundle:Home:home.html.twig');
    }

}
