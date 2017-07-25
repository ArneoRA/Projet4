<?php

namespace Louvre\BookingBundle\Controller;

use Louvre\BookingBundle\Entity\DetailReservation;
use Louvre\BookingBundle\Entity\Reservation;
use Louvre\BookingBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BookingController extends Controller
{
    public function bookingAction(Request $request)
    {
        // Création de l'objet Reservation et DétailReservation
        $resa = new Reservation();

        // Création du Formulaire
        $form = $this->get('form.factory')->create(ReservationType::class, $resa);
        // ou encore plus court = $form = $this->createForm(ReservationType::class, $resa);

        // Si la requete est en POST
        if ($request->isMethod('POST')){
            //On fait le lien Requete <->Formulaire
            // A partir de maintenant, la variable $resa contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);
            // On vérifie que les valeurs entrées sont correctes
            if ($form->isValid()){
                // On enregistre notre objet $resa dans la base de données
                $em = $this->getDoctrine()->getManager();
                $em->persist($resa);
                // la ligne ci-dessous est en commentaire car nous avons mis cascade={"persist"} directement dans la liaison
                //$em->persist($resa->getDetailResa()); // On persiste les informations Détail réservation
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Réservation bien enregistrée.');

                // On redirige vers la page Order pour l'instant avec le contenu de la réservation
                $ordre = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('LouvreBookingBundle:Reservation')
                    ->find($resa->getId());
                $detail = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('LouvreBookingBundle:DetailReservation')
                    ->find($resa->getDetailResa());
//                $pays = $this->getDoctrine()
//                    ->getManager()
//                    ->getRepository('LouvreBookingBundle:Pays')
//                    ->find($detailR->getPaysVisiteur());

                return $this->render('LouvreBookingBundle:Order:prepare.html.twig', array(
                    'ordres' => $ordre,
                    'detail' => $detail
//                    'pays'   => $pays
                ));
            }
        }

        return $this->render('LouvreBookingBundle:Booking:booking.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
