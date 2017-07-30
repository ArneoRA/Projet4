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

        // Obtenez les détails de la carte de crédit soumis par le formulaire
        $token = $_POST['stripeToken'];
        $email = $_POST['email']; // Récupéré depuis le formulaire prepare.html.twig
        $name = $_POST['name']; // Récupéré depuis le formulaire booking.html.twig si possible
        $montant = $_POST['montant']; // Récupéré depuis le formulaire booking.html.twig si possible


        // Créer une charge: cela facturera la carte de l'utilisateur
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $montant * 100, // Montant en centimes
                "currency" => "eur",
                "source" => $token,
                "description" => 'Paiement Stripe de ' . $name . '[' . $email . ']'
            ));
            $this->addFlash("success","Bravo ça marche !");
            return $this->redirectToRoute("order_prepare");

        } catch(\Stripe\Error\Card $e) {

            $this->addFlash("error","Snif ça marche pas :(");
            return $this->redirectToRoute("order_prepare");
            // The card has been declined
        }
    }

}
