<?php

namespace Louvre\BookingBundle\Controller;

use Louvre\BookingBundle\Entity\Reservation;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


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

    public function datesNoDispoAction()
    {
        ///// Intégration des jours de fermeture du Musée
        // Déclaration du tableau
        $exclus = array();
        // Insertion des dates au format timestamp dans la variable $exclus
        array_push($exclus, strtotime('2017-05-01'));
        array_push($exclus, strtotime('2017-11-01'));
        array_push($exclus, strtotime('2017-12-25'));
        // Traitement des dates dont le nbre de billets MAX est atteint
        $em = $this->getDoctrine()->getManager();
        // Récupération de la liste des dates avec la somme des billets associés
        $listDates = $em->getRepository('LouvreBookingBundle:Reservation')->datesNonDispo();
        // Pour chaque enregistrement
        foreach ($listDates as $key => $val) {
            // Test du Nbre de places total
            if ($val['Places']== Reservation::BILLET_MAX){
                // Si Places égal Billet Max, on ajoute la date dans notre variable
                array_push($exclus, strtotime($val['dateVisite']));
            };
        }
        $response = new JsonResponse($exclus);
        return $response;
    }

}
