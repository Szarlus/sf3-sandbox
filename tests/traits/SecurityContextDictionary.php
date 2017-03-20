<?php

namespace tests\traits;


trait SecurityContextDictionary
{
    protected function userIsAuthenticatedAs($username)
    {
        $this->client()->setServerParameters([
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW' => 'P@ssw0rd'
        ]);
    }

    private function userIsNotAuthenticated()
    {
        $this->client()->setServerParameters([]);
    }
}