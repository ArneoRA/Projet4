<?php

namespace  Louvre\BookingBundle\Tests\Entity;

use Louvre\BookingBundle\Entity\DetailReservation;

class DetailReservationTest extends \PHPUnit_Framework_TestCase
{
    public function testgetNomVisiteur()
    {
        $detail = new DetailReservation();

        $detail->setNomVisiteur('TEST');
        $this->assertEquals('TEST', $detail->getNomVisiteur());
    }

    public function testgetDateNaissance()
    {
        $detail = new DetailReservation();
        $date = Date('Y-m-d', strtotime("1975-11-15"));
        $detail->setDateNaissance($date);
        $this->assertEquals('1975-11-15', $detail->getDateNaissance());
    }

    public function testgetTarifVisiteur()
    {
        $detail = new DetailReservation();
        $detail->setTarifvisiteur(16);
        $this->assertEquals(16, $detail->getTarifvisiteur());
    }

}