<?php

namespace Tests\AppBundle\Controller;


use AppBundle\Entity\User;
use tests\traits\DatabaseDictionary;
use tests\traits\FormLoginAuthDictionary;
use tests\WebTestCase;

class UserSecuredControllerTest extends WebTestCase
{
    use FormLoginAuthDictionary;
    use DatabaseDictionary;

    protected function setUp()
    {
        parent::setUp();
        $this->purgeDatabase();
    }

    /** @test */
    public function itDisplaysWelcomeMessage()
    {
        $this->userExists();
        $this->userIsAuthenticatedAs('user');

        $crawler = $this->client()->request('GET', '/secure');

        $this->assertEquals(200, $this->lastResponse()->getStatusCode());
        $this->assertContains('User panel', $crawler->filter('#container h1')->text());
    }

    /** @test */
    public function itRedirectsToLoginFormIfUserIsNotAuthenticated()
    {
        $this->client()->request('GET', '/secure');

        $this->assertTrue($this->client()->getResponse()->isRedirect());
        $crawler = $this->client()->followRedirect();

        $form = $crawler->selectButton('_submit')->form();

        $this->assertTrue($form->has('_username'));
        $this->assertTrue($form->has('_password'));
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
