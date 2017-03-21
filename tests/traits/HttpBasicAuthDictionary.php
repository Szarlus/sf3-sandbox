<?php

namespace tests\traits;


trait HttpBasicAuthDictionary
{
    protected function userIsAuthenticatedAs($username)
    {
        $this->client()->setServerParameters([
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW' => 'P@ssw0rd'
        ]);
    }

    protected function userIsNotAuthenticated()
    {
        $this->client()->setServerParameters([]);
    }
}