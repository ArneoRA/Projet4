<?php

namespace Louvre\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        $service = $this->container->get('Louvre_Booking.Traitements');
//        $place = $service->getPlace(345);

        return $this->render('LouvreBookingBundle:Home:home.html.twig');
    }

}
