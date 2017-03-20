<?php

namespace tests;

abstract class JsonApiTestCase extends WebTestCase
{
    protected function sendJsonRequest($method, $url, array $requestData = [])
    {
        $this->client()->request($method, $url, $requestData, [], [
            'CONTENT_TYPE' => 'application/json'
        ]);
    }

    protected function getResponseContentAsArray()
    {
        return json_decode($this->lastResponse()->getContent(), true);
    }
}
