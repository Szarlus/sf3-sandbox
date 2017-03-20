<?php

namespace Tests\AppBundle\Controller;


use tests\traits\SecurityContextDictionary;
use tests\WebTestCase;

class AdminSecuredControllerTest extends WebTestCase
{
    use SecurityContextDictionary;

    /** @test */
    public function itDisplaysWelcomeMessage()
    {
        $this->userIsAuthenticatedAs('admin');

        $crawler = $this->client()->request('GET', '/admin/secure');

        $this->assertEquals(200, $this->lastResponse()->getStatusCode());
        $this->assertContains('Admin panel', $crawler->filter('#container h1')->text());
    }

    /** @test */
    public function itReturns403IfUserIsNotAdmin()
    {
        $this->userIsAuthenticatedAs('user');

        $this->client()->request('GET', '/admin/secure');

        $this->assertEquals(403, $this->lastResponse()->getStatusCode());
    }

    /** @test */
    public function itReturns401IfUserIsNotAuthenticated()
    {
        $this->userIsNotAuthenticated();

        $this->client()->request('GET', '/admin/secure');

        $this->assertEquals(401, $this->lastResponse()->getStatusCode());
    }
}
