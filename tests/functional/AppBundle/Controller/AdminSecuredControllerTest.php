<?php

namespace tests\functional\AppBundle\Controller;


use AppBundle\Entity\User;
use tests\traits\DatabaseDictionary;
use tests\traits\HttpBasicAuthDictionary;
use tests\WebTestCase;

class AdminSecuredControllerTest extends WebTestCase
{
    use HttpBasicAuthDictionary;
    use DatabaseDictionary;

    protected function setUp()
    {
        parent::setUp();
        $this->purgeDatabase();
    }


    /** @test */
    public function itDisplaysWelcomeMessage()
    {
        $this->adminExists();
        $this->userIsAuthenticatedAs('admin');

        $crawler = $this->client()->request('GET', '/admin/secure');

        $this->assertEquals(200, $this->lastResponse()->getStatusCode());
        $this->assertContains('Admin panel', $crawler->filter('#container h1')->text());
    }

    /** @test */
    public function itReturns403IfUserIsNotAdmin()
    {
        $this->userExists();
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

    private function adminExists()
    {
        $userManager = $this->container()->get('fos_user.user_manager');

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPlainPassword('P@ssw0rd');
        $user->setEnabled(true);

        $userManager->updateUser($user);
    }

    private function userExists()
    {
        $userManager = $this->container()->get('fos_user.user_manager');

        $user = new User();
        $user->setUsername('user');
        $user->setEmail('user@example.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPlainPassword('P@ssw0rd');
        $user->setEnabled(true);

        $userManager->updateUser($user);
    }
}
