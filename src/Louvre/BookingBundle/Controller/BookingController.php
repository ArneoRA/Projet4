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
//        $resa->addDetail(new DetailReservation());


        // Création du Formulaire
        $form = $this->get('form.factory')->create(ReservationType::class, $resa);
        // ou encore plus court = $form = $this->createForm(ReservationType::class, $resa);

        // Si la requete est en POST
        if ($request->isMethod('POST')){
            error_log('Je suis dans le test if isMethod');
            //On fait le lien Requete <->Formulaire
            // A partir de maintenant, la variable $resa contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);
            var_dump($form->getData());
            // On vérifie que les valeurs entrées sont correctes
            if ($form->isSubmitted() && $form->isValid()){
                error_log('Je passe dans le test isubmitted');
                $resa = $form->getData();
                // On enregistre notre objet $resa dans la base de données
                $em = $this->getDoctrine()->getManager();
//                var_dump($form);
                $em->persist($resa);
                $em->flush();

//                return $this->render('LouvreBookingBundle:Home:home.html.twig');


                $request->getSession()->getFlashBag()->add('notice', 'Réservation bien enregistrée.');

                // On redirige vers la page Order pour l'instant avec le contenu de la réservation
                $ordre = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('LouvreBookingBundle:Reservation')
                    ->find($resa->getId());
                $detail = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('LouvreBookingBundle:DetailReservation')
                    ->find($resa->getDetails());
                $pays = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('LouvreBookingBundle:Pays')
                    ->find($detail->getPaysVisiteur());

                return $this->render('LouvreBookingBundle:Order:prepare.html.twig', array(
                    'ordres' => $ordre,
                    'detail' => $detail,
                    'pays'   => $pays
                ));
            }
        }

        return $this->render('LouvreBookingBundle:Booking:booking.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    public function testAction($id)
    {
        // Création de l'objet DétailReservation
        $detailR = new DetailReservation();

        // Création du Formulaire
        $formD = $this->get('form.factory')->create(DetailReservationType::class, $detailR);

        // ou encore plus court = $form = $this->createForm(ReservationType::class, $resa);

        $resa = new Reservation();

        // On redirige vers l'étape 2 (saisie des autres visiteurs)
        $ordre = $this->getDoctrine()->getManager()->getRepository('LouvreBookingBundle:Reservation')->findOneById($id);
        error_log('reservation récupérée');
        $detail = $this->getDoctrine()->getManager()->getRepository('LouvreBookingBundle:DetailReservation')->find($ordre->getDetails());
        var_dump($detail);
        $pays = $this->getDoctrine()->getManager()->getRepository('LouvreBookingBundle:Pays')->find($detail->getPaysVisiteur());

        return $this->render('LouvreBookingBundle:Booking:visiteurs.html.twig', array(
            'ordres' => $ordre,
            'detail' => $detail,
            'pays'   => $pays,
            'formD' => $formD->createView(),
        ));
    }




}
