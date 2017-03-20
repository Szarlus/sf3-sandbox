<?php

namespace tests;

use Symfony\Bundle\FrameworkBundle\Client;

abstract class WebTestCase extends IntegrationTestCase
{
    /** @var Client */
    private $client;

    protected function setUp()
    {
        parent::setUp();

        $this->client = $this->container()->get('test.client');
    }

    /**
     * @return Client
     */
    protected function client()
    {
        return $this->client;
    }

    protected function lastResponse()
    {
        return $this->client()->getResponse();
    }

    protected function assertStatusCodeEquals($statusCode)
    {
        $this->assertEquals($statusCode, $this->lastResponse()->getStatusCode());
    }
}
