<?php

namespace LouvreBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class OrderControllerTest extends WebTestCase
{
    public function testviewAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/order/1');
        $this->assertEquals(1,  $crawler->filter('li:contains("lM5cp0FkZI")')->count());
    }

    public function testcheckedAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/checked/lM5cp0FkZI');
        $this->assertEquals(1,  $crawler->filter('h4:contains("Merci pour votre visite.")')->count());
    }
}
