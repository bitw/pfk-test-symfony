<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddressControllerTest extends WebTestCase
{
    public function testIndex()
    {
	    $client = static::createClient();

	    $crawler = $client->request('GET', '/address');

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());
	    $this->assertContains('Аптеки', $crawler->filter('.container h1')->text());
    }
}
