<?php

namespace Tests\AppBundle\Controller;


use tests\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $crawler = $this->client()->request('GET', '/');

        $this->assertEquals(200, $this->lastResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
