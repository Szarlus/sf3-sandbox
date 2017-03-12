<?php

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TasksLimitNotReached extends Constraint
{
    public $message = 'User %username% has more than %limit% tasks assigned';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}