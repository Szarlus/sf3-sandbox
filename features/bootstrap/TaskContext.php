<?php

namespace features\bootstrap;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use tests\traits\DatabaseDictionary;

/**
 * Defines application features from the specific context.
 */
class TaskContext implements Context
{
    use DatabaseDictionary;

    /**
     * @Given user :arg1 exists
     */
    public function userExists($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given category :arg1 exists
     */
    public function categoryExists($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given a customer named :arg1
     */
    public function aCustomerNamed($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given a blog named :arg1 owned by :arg2
     */
    public function aBlogNamedOwnedBy($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given I am adding new task
     */
    public function iAmAddingNewTask()
    {
        throw new PendingException();
    }

    /**
     * @Given I fill in task name as :arg1
     */
    public function iFillInTaskNameAs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I fill in description as :arg1
     */
    public function iFillInDescriptionAs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I set due date to :arg1
     */
    public function iSetDueDateTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I select :arg1 category
     */
    public function iSelectCategory($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I assign the task to :arg1
     */
    public function iAssignTheTaskTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I submit the task form
     */
    public function iSubmitTheTaskForm()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be redirected to task view page
     */
    public function iShouldBeRedirectedToTaskViewPage()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1 message
     */
    public function iShouldSeeMessage($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then The task should be saved
     */
    public function theTaskShouldBeSaved()
    {
        throw new PendingException();
    }

}
