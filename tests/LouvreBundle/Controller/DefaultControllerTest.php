<?php

namespace LouvreBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class DefaultControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/');
        $this->assertEquals(1,  $crawler->filter('a:contains("Billeterie du Musée du Louvre")')->count());
    }

    public function testMentionsAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/mentions');
        $this->assertEquals(1,  $crawler->filter('h3:contains("Mentions légales")')->count());
    }
}
