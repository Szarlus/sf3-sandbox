<?php

namespace tests\functional\AppBundle\Controller;


use tests\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /** @test */
    public function itDisplaysWelcomeMessage()
    {
        $crawler = $this->client()->request('GET', '/');

        $this->assertEquals(200, $this->lastResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
