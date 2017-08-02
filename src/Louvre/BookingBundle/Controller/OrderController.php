<?php

namespace Louvre\BookingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Louvre\BookingBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/prepare", name="order_prepare")
     */
    public function prepareAction()
    {
        return $this->render('LouvreBookingBundle:Order:prepare.html.twig');
    }


    public function viewAction($id)
    {
        // On redirige vers la page Order pour l'instant avec le contenu de la réservation
        $ordre = $this->getDoctrine()
            ->getManager()
            ->getRepository('LouvreBookingBundle:Reservation')
            ->find($id);
        $details = $ordre->getDetails();

        return $this->render('LouvreBookingBundle:Order:prepare.html.twig', array(
            'ordres' => $ordre,
            'details' => $details
        ));
    }

    /**
     * @Route(
     *     "/checkout",
     *     name="order_checkout",
     *     methods="POST"
     * )
     */
    public function checkoutAction(Request $request)
    {
        \Stripe\Stripe::setApiKey("sk_test_158n98qYZ53ogoXzOfMZdQzo"); // Clé Secret Stripe

        $em = $this->getDoctrine()->getManager();
        // Récupération des élements de paiement
        $token = $_POST['stripeToken'];
        $email = $_POST['stripeEmail']; // Récupérée depuis Stripe
        $montant = $_POST['montant'];
        $id = $_POST['idRes'];

        // Créer une charge: cela facturera la carte de l'utilisateur
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $montant * 100, // Montant en centimes
                "currency" => "eur",
                "source" => $token,
                "description" => 'Paiement Stripe de : '. $montant . '€ pour la réservation de l\'adresse Email : ' . $email
            ));
            // MAJ du Montant total de la réservation
            $resa = $em->getRepository('LouvreBookingBundle:Reservation')->find($id);
            var_dump($resa->getValided());
            $resa->setValided(true);
            $em->persist($resa);
            $em->flush();
            var_dump($resa->getValided());
            return $this->redirectToRoute('louvre_booking_checked', array('code' =>$resa->getCodeReservation()));

        } catch(\Stripe\Error\Card $e) {
            return $this->redirectToRoute('louvre_booking_view');
            // The card has been declined
        }
    }

    public function checkedAction($code)
    {

        // On réaffiche l'ensemble de la réservation avec le détail
        $ordre = $this->getDoctrine()
            ->getManager()
            ->getRepository('LouvreBookingBundle:Reservation')
            ->findOneBy(array('codeReservation' => $code));
        $details = $ordre->getDetails();

        // Envoi du mail contenant les informations de la réservation

        return $this->render('LouvreBookingBundle:Order:valided.html.twig', array(
            'ordres' => $ordre,
            'details' => $details
        ));
    }

}
