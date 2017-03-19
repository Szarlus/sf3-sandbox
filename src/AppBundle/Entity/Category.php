<?php

namespace AppBundle\Entity;


class Category
{
    private $id;

    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}