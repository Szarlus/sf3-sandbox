<?php

namespace AppBundle\Service;


class MyServiceA
{
    private $serviceB;

    public function __construct(MyServiceB $serviceB)
    {
        $this->serviceB = $serviceB;
    }
}