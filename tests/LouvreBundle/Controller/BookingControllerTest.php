<?php

namespace LouvreBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class BookingControllerTest extends WebTestCase
{
    // Test de chargement de la page
    public function testBookingAction()
    {
        $client = static::createClient();
        $client->request('GET','/booking');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

}
