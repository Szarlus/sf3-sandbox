<?php

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TasksLimitNotReached extends Constraint
{
    public $message = 'User %username% has more than 2 tasks assigned';
}