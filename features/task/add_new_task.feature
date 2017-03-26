Feature: Add new task

  Background:
    Given user "john" exists
      And category "bug" exists
      And a customer named "Wilson"
      And a blog named "Expensive Therapy" owned by "Wilson"

  Scenario: Add new task
    Given I am adding new task
      And I fill in task name as "test task"
      And I fill in description as "test description"
      And I set due date to "20/02/2010"
      And I select "bug" category
      And I assign the task to "john"
     When I submit the task form
     Then I should be redirected to task view page
      And I should see "Task was added" message
      And The task should be saved