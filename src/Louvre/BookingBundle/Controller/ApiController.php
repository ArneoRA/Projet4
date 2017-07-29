<?php

namespace Louvre\BookingBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Louvre\BookingBundle\Entity\DetailReservation;
use Louvre\BookingBundle\Entity\Reservation;
use Louvre\BookingBundle\Form\DetailReservationType;
use Louvre\BookingBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ApiController extends Controller
{
    public function subformAction($places)
    {
        var_dump($places);
        die('Route et Action OK');

    }

}
