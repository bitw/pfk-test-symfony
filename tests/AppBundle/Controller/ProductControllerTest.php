<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testIndex()
    {
	    $client = static::createClient();

	    $crawler = $client->request('GET', '/product');

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());
	    $this->assertContains('Препараты', $crawler->filter('.container h1')->text());
    }
}
