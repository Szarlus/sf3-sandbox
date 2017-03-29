<?php

namespace tests\unit\AppBundle\Validator\Constraints;


use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use AppBundle\Validator\Constraints\TasksLimitNotReached;
use AppBundle\Validator\Constraints\TasksLimitNotReachedValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class TasksLimitNotReachedValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new TasksLimitNotReachedValidator();
    }

    /** @test */
    public function itRaisesNoViolationIfSubjectIsNotATask()
    {
        $this->validator->validate(new \stdClass(), new TasksLimitNotReached());

        $this->assertNoViolation();
    }

    /** @test */
    public function itRaisesNoViolationIfNoUserIsAssignedToTheTask()
    {
        $this->validator->validate(new Task(), new TasksLimitNotReached());

        $this->assertNoViolation();
    }

    /** @test */
    public function itRaisesNoViolationIfUserIsAlreadyAssignedToTheTask()
    {
        $task = new Task();
        $user = new User();
        $user->assignTo(new Task());
        $user->assignTo(new Task());
        $user->assignTo($task);

        $task->setAssignedTo($user);

        $this->validator->validate($task, new TasksLimitNotReached());

        $this->assertNoViolation();
    }

    /** @test */
    public function itRaisesViolationIfUserWasNotYetAssignedToTheTaskAndHasThreeOtherTasksAssigned()
    {
        $user = new User();
        $user->setUsername('test user');
        $user->assignTo(new Task());
        $user->assignTo(new Task());
        $user->assignTo(new Task());

        $task = new Task();
        $task->setAssignedTo($user);

        $constraint = new TasksLimitNotReached();

        $this->validator->validate($task, $constraint);

        $this
            ->buildViolation($constraint->message)
            ->setParameter('%username%', 'test user')
            ->setParameter('%limit%', 3)
            ->atPath('property.path.assignedTo')
            ->assertRaised();
    }
}
