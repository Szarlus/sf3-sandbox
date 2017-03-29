<?php

namespace AppBundle\Service;


class MyServiceWithLazyDependency
{
    private $serviceB;

    public function __construct(MyServiceB $serviceB)
    {
        $this->serviceB = $serviceB;
    }

    public function showWhatItImplements()
    {
        var_dump(class_implements($this->serviceB));
    }

    public function callB()
    {
        return $this->serviceB->hello();
    }
}