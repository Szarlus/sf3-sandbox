<?php

namespace Tests\AppBundle\Controller;


use tests\traits\SecurityContextDictionary;
use tests\WebTestCase;

class UserSecuredControllerTest extends WebTestCase
{
    use SecurityContextDictionary;

    /** @test */
    public function itDisplaysWelcomeMessage()
    {
        $this->userIsAuthenticatedAs('user');

        $crawler = $this->client()->request('GET', '/secure');

        $this->assertEquals(200, $this->lastResponse()->getStatusCode());
        $this->assertContains('User panel', $crawler->filter('#container h1')->text());
    }

    /** @test */
    public function itReturns401IfUserIsNotAuthenticated()
    {
        $this->userIsNotAuthenticated();

        $this->client()->request('GET', '/admin/secure');

        $this->assertEquals(401, $this->lastResponse()->getStatusCode());
    }
}
