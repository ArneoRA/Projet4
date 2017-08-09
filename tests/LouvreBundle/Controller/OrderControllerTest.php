<?php

namespace LouvreBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class OrderControllerTest extends WebTestCase
{
    // Tests valables uniquement sur la base Localhost de mon PC
    // CodeReservation étant généré aléatoirement, il ne sera pas le meme sur le VPS

    public function testviewAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/order/1');
        $this->assertEquals(1,  $crawler->filter('li:contains("TQrMJyPkJW")')->count());
    }

    public function testcheckedAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/checked/TQrMJyPkJW');
        $this->assertEquals(1,  $crawler->filter('h4:contains("Merci pour votre visite.")')->count());
    }
}
