<?php
/**
 * Created by PhpStorm.
 * User: Radan
 * Date: 30/07/2017
 * Time: 09:21
 */
namespace Louvre\BookingBundle\Tests\Services;


use Louvre\BookingBundle\Services\Traitements;
use PHPUnit\Framework\TestCase;


class TraitementsTest extends PHPUnit_Framework_TestCase
{
    // Récupération du nombre de billets Max par jour via
    // le parametre mis dans le fichier app/config/parameters.tml
    private $billet_max;


    public function __construct($billet_max)
    {
        $this->billet_max = $billet_max;
    }

    // Calcul du nombre de places restante à la vente
    public function testgetPlace()
    {
        $places = 15;
        $tarif = $this->billet_max - $places;
        $this->assertEquals(985, $this->service->getPlace($places));
    }

    // MAJ du champ Tarif par rapport à l'année de naissance / Type de réservation et Si tarif Réduit
    public function  testgetTarif()
    {
        $dt = new \DateTime();
        $dateJ = $dt->format('Y');
        $date = 1975;
        $reduit = 0;
        $type = 1;
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

        $this->assertEquals(16, $this->service->getTarif($date,$reduit, $type));
    }
}
