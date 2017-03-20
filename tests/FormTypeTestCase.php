<?php

namespace tests;


use Symfony\Component\Form\FormInterface;

abstract class FormTypeTest extends IntegrationTestCase
{
    /** @var FormInterface */
    protected $form;

    abstract protected function formTypeClass();

    protected function validData()
    {
        return [];
    }

    protected function validDataWith(array $data)
    {
        return array_replace_recursive($this->validData(), $data);
    }

    protected function validDataBut(array $data)
    {
        return $this->validDataWith($data);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->form = $this->container()->get('form.factory')->create($this->formTypeClass());
    }
}
