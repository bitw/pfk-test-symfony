<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ИмпортControllerTest extends WebTestCase
{
    public function testIndex()
    {
	    $client = static::createClient();

	    $crawler = $client->request('GET', '/import');

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());
	    $this->assertContains('Импортирование данных', $crawler->filter('.container h1')->text());
    }
}
