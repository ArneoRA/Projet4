<?php

namespace Louvre\BookingBundle\Controller;

use Louvre\BookingBundle\Entity\DetailReservation;
use Louvre\BookingBundle\Entity\Reservation;
use Louvre\BookingBundle\Form\DetailReservationType;
use Louvre\BookingBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class BookingController extends Controller
{
    public function bookingAction(Request $request)
    {
        // Création de l'objet Reservation
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
            if ($form->isSubmitted() && $form->isValid()){
                // On enregistre notre objet $resa dans la base de données
                $em = $this->getDoctrine()->getManager();
//                var_dump($form);
                $em->persist($resa);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Réservation bien enregistrée.');

                return $this->render('LouvreBookingBundle:Home:home.html.twig');

//                // On redirige vers la page prepare pour l'instant avec le contenu de la réservation
//                $ordre = $this->getDoctrine()
//                    ->getManager()
//                    ->getRepository('LouvreBookingBundle:Reservation')
//                    ->find($resa->getId());
////                var_dump($resa->getId());
////                var_dump($resa->getDetails());
//                $detail = $this->getDoctrine()
//                    ->getManager()
//                    ->getRepository('LouvreBookingBundle:Reservation')
//                    ->getDetailResa($resa->getId());
//
//                return $this->render('LouvreBookingBundle:Order:prepare.html.twig', array(
//                    'ordres' => $ordre,
//                    'details' => $detail
//                ));
            }
        }

        return $this->render('LouvreBookingBundle:Booking:booking.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    public function testAction($id)
    {
        // On affiche les données
        $ordre = $this->getDoctrine()->getManager()->getRepository('LouvreBookingBundle:Reservation')->find($id);
        error_log('reservation récupérée');
        $details = $this->getDoctrine()->getManager()->getRepository('LouvreBookingBundle:Reservation')->resaWithdetails($id);
        var_dump($details);

        return $this->render('LouvreBookingBundle:Booking:visiteurs.html.twig', array(
            'ordres' => $ordre,
            'details' => $details
        ));
    }




}
