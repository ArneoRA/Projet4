<?php

namespace Louvre\BookingBundle\Controller;

use Louvre\BookingBundle\Entity\Reservation;
use Louvre\BookingBundle\Form\Type\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Louvre\BookingBundle\Services;


class BookingController extends Controller
{
    public function bookingAction(Request $request)
    {
        // Déclaration des différents éléments de base
        $resa = new Reservation();
        ////// Service Traitements
        $services = $this->container->get('Louvre_Booking.Traitements');

        // Création du formulaire réservation
        $form = $this->createForm(ReservationType::class, $resa);

        //Enregistrement des informations du formulaire et sous-formulaire
        if ($request->isMethod('POST')){
            //On fait le lien Requete <->Formulaire la variable $resa contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);
            // On vérifie que les valeurs entrées sont correctes
            if ($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($resa);
                $em->flush();
                // MAJ DES INFOS SUR LES VISITEURS (Tarif, MAJ champ idresa et persist/Flush)
                $detR = $resa->getDetails();
                $montantR = $services->setdetailVisiteurs($em, $resa, $detR);
                // MAJ DU MONTANT TOTAL DE LA RESERVATION
                $resa->setMontantReservation($montantR);
                $em->persist($resa);
                $em->flush();
                // Redirection vers la page récapitulative
                return $this->redirectToRoute('louvre_booking_view', array(
                    'id'    => $resa->getId()
                ));
            }
        }
        return $this->render('LouvreBookingBundle:Booking:booking.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    public function testAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        // On affiche la réservation avec les visiteurs associés
        $ordre = $em->getRepository('LouvreBookingBundle:Reservation')->find($id);
        // On intercepte l'exception si la réservation n'existe pas
        if ($ordre === null) {
            throw new NotFoundHttpException("La réservation numéro : ".$id." n'existe pas.");
        }
        // Récupération de la liste des visiteurs de la réservation
        $details = $ordre->getDetails();
        // On intercepte l'exception si il n'y a pas de détail de réservation
        if ($details === null) {
            throw new NotFoundHttpException("Il n'existe pas de visiteurs pour la réservation numéro : ".$id);
        }
        // On affiche le tout dans la vue Visiteurs
        return $this->render('LouvreBookingBundle:Booking:visiteurs.html.twig', array(
            'ordres' => $ordre,
            'details' => $details
        ));

    }




}
