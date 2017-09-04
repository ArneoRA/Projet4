<?php

namespace Louvre\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('LouvreBookingBundle:Default:home.html.twig');
    }

    public function mentionsAction()
    {

        return $this->render('LouvreBookingBundle:Default:mentions.html.twig');
    }

    public function contactAction()
    {

        return $this->render('LouvreBookingBundle:Default:contact.html.twig');
    }

}
