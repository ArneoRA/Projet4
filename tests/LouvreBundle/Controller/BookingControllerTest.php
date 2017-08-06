<?php

namespace LouvreBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class BookingControllerTest extends WebTestCase
{
    public function testBookingAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/booking');
        $this->assertEquals(1,  $crawler->filter('label:contains("Email du Réservant")')->count());
    }

}
