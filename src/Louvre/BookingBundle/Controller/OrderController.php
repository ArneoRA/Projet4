<?php

namespace Louvre\BookingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Louvre\BookingBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

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
        //$request = Request::createFromGlobals();

        $em = $this->getDoctrine()->getManager();
        // Récupération des élements de paiement
        $token = $request->request->get('stripeToken');
        $email = $request->request->get('stripeEmail'); // Récupérée depuis Stripe
        $montant = $request->request->get('montant');
        $id = $request->request->get('idRes');
        // Créer une charge: cela facturera la carte de l'utilisateur
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $montant * 100, // Montant en centimes
                "currency" => "eur",
                "source" => $token,
                "description" => 'Paiement Stripe de : '. $montant . '€ pour la réservation de l\'adresse Email : ' . $email
            ));
            // Inscription de l'échange dans le fichier log
            $dateFormat = "Y-m-d H:i:s";
            $output = "[%datetime%] [%channel%] [%level_name%] %message% %context% \n";
            $formatter = new LineFormatter($output, $dateFormat);
            $streamHandler = new StreamHandler('/var/logs/charges.log', Logger::INFO);
            $streamHandler->setFormatter($formatter);
            $log = new Logger('CHARGE');
            $log->pushHandler($streamHandler);
            $log->addDebug('Contenu de la charge : ' . $charge);

            // MAJ du Montant total de la réservation
            $resa = $em->getRepository('LouvreBookingBundle:Reservation')->find($id);
            $resa->setValided(true);
            $em->persist($resa);
            $em->flush();
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

        // Préparation du mail contenant les informations de la réservation
        $message = \Swift_Message::newInstance()
            ->setSubject('Musée du Louvre - Votre réservation : [' .$ordre->getCodeReservation() . ']')
            ->setFrom('arneo.42@gmail.com')
            ->setTo($ordre->getEmailClient())
            ->setContentType('text/html')
            ->setBody($this->renderView('LouvreBookingBundle:Email:mail.html.twig', array(
                'ordres'    =>$ordre,
                'details'   =>$details
            )));
        // Envoi du mail
        $this->get('mailer')
            ->send($message);

        // Retourne la vue de validation
        return $this->render('LouvreBookingBundle:Order:valided.html.twig', array(
            'ordres' => $ordre,
            'details' => $details
        ));
    }

    // METHODE POUR TESTER LA VUE EMAIL
    public function testmailAction($code)
    {
        // On réaffiche l'ensemble de la réservation avec le détail
        $ordre = $this->getDoctrine()
            ->getManager()
            ->getRepository('LouvreBookingBundle:Reservation')
            ->findOneBy(array('codeReservation' => $code));
        $details = $ordre->getDetails();


        // Retourne la vue de validation
        return $this->render('LouvreBookingBundle:Email:mail.html.twig', array(
            'ordres' => $ordre,
            'details' => $details
        ));
    }

}
