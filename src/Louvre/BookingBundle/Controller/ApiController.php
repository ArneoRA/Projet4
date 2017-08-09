<?php

namespace Louvre\BookingBundle\Controller;

use Louvre\BookingBundle\Entity\Reservation;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller
{

    public function nbrePlaceAction($date)
    {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('LouvreBookingBundle:Reservation')->placeJours($date);
        $place = Reservation::BILLET_MAX - $result;

        $response = new Response($place);
        return $response;
    }

}
