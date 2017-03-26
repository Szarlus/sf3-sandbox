<?php

namespace AppBundle\Service;


class MyServiceAFactory
{
    public function create(MyServiceB $serviceB)
    {
        return new MyServiceA($serviceB);
    }
}