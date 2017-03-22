<?php

namespace AppBundle\Validator\Constraints;


use AppBundle\Entity\Task;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TasksLimitNotReachedValidator extends ConstraintValidator
{
    private $limit = 2;

    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof Task || !$value->getAssignedTo()) {
            return;
        }

        $user = $value->getAssignedTo();

        if ($user->isAssignedToTask($value) || $user->getNbOfAssignedTasks() < $this->limit) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->setParameter('%username%', $user->getUsername())
            ->setParameter('%limit%', $this->limit)
            ->atPath('assignedTo')
            ->addViolation();
    }
}
