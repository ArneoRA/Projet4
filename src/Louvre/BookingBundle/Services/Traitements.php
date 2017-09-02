<?php

namespace Louvre\BookingBundle\Services;

use Doctrine\ORM\EntityManager;
use Louvre\BookingBundle\Entity\Reservation;


class Traitements
{
    // Récupération du nombre de billets Max par jour via
    // le parametre mis dans le fichier app/config/parameters.yml
    private $billet_max;

    // Utilisation d'EntityManager dans les méthodes de ma class Traitement
    protected $em;

    public function __construct($billet_max, EntityManager $em)
    {
        $this->billet_max = $billet_max;
        $this->em = $em;
    }

    // Calcul du nombre de places restante à la vente
    public function getPlace($places)
    {
        $tarif = $this->billet_max - $places;
        return $tarif;
    }

    // MAJ du champ Tarif par rapport à l'année de naissance / Type de réservation et Si tarif Réduit
    public function  getTarif($date, $reduit, $type)
    {
        $dt = new \DateTime();
        $dateJ = $dt->format('Y');
        $diff = $dateJ - $date;
        $tarif = 0;

        if($reduit == 1){                                // Tarif réduit 10€ / 5€
            if ($type == 1) {
                $tarif = 10;
            } else {
                $tarif = 5;
            }
        }elseif ($diff > 4 && $diff < 12){                // à partir de 4 ans et jusqu’à 12 ans Tarif 8 € / 4€
            if ($type == 1) {
                $tarif = 8;
            } else {
                $tarif = 4;
            }
        } elseif ($diff > 12 && $diff < 60){             // à partir de 12 ans à 16 € Tarif 16€ / 8€
            if ($type == 1) {
                $tarif = 16;
            } else {
                $tarif = 8;
            }
        } elseif ($diff > 60){                          // à partir de 60 ans Tarif 12€ / 6%
            if ($type == 1) {
                $tarif = 12;
            } else {
                $tarif = 6;
            }
        }

        return $tarif;
    }

    // Traitement Details réservation
    public function setdetailVisiteurs(Reservation $resa, $detR)
    {

        $montantR = 0;
        foreach ($detR as $key => $value) {
            // MAJ du champ IdResa
            $detR[$key]->setIdResa($resa->getId());
            // CALCUL Tarif en fonction de la Date de Naissance
            $type = $resa->getTypeReservation();
            $dt= $detR[$key]->getDateNaissance();
            $annee = $dt->format('Y');
            $reduit = $detR[$key]->getTarifReduit();
            $detR[$key]->setTarifVisiteur($this->getTarif($annee, $reduit, $type));
            // CUMUL TARIF
            $montantR +=$detR[$key]->getTarifVisiteur();
            // PERSIST Les MAJ
            $this->em->persist($detR[$key]);
        }
        $this->em->flush();
        return $montantR;
    }

}
