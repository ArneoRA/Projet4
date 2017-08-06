<?php

namespace  Louvre\BookingBundle\Tests\Entity;

use Louvre\BookingBundle\Entity\Reservation;

class ReservationTest extends \PHPUnit_Framework_TestCase
{
    public function testgetNbrePlaces()
    {
        $reservation = new Reservation();
        $reservation->setNbrePlaces(1);
        $this->assertEquals(1, $reservation->getNbrePlaces());
    }

    public function testsetTypeReservation()
    {
        $reservation = new Reservation();
        $reservation->setTypeReservation(true);
        $this->assertEquals(true, $reservation->getTypeReservation());
    }

    public function testsetValided()
    {
        $reservation = new Reservation();
        $reservation->setValided(true);
        $this->assertEquals(true, $reservation->getValided());
    }
}