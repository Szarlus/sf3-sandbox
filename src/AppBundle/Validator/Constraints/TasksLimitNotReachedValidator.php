<?php

namespace AppBundle\Validator\Constraints;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TasksLimitNotReachedValidator extends ConstraintValidator
{
    /**
     * @var EntityRepository
     */
    private $tasksRepository;

    public function __construct(EntityRepository $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof User) {
            return;
        }

        $assignedTasks = $this->tasksRepository->findBy(['assignedTo' => $value]);
        $nbOfAssignedTasks = count($assignedTasks);

        if ($nbOfAssignedTasks < 2) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->setParameter('%username%', $value->getUsername())
            ->addViolation();
    }
}