<?php

namespace tests\functional\AppBundle\Page;


use AppBundle\Entity\Category;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Task;
use tests\PageTestCase;
use tests\traits\DatabaseDictionary;

class TasksListPageTest extends PageTestCase
{
    use DatabaseDictionary;

    protected function setUp()
    {
        parent::setUp();

        $this->purgeDatabase();
    }

    protected function createPage()
    {
        return new TasksListPage($this->client()->request('GET', '/task/list'));
    }

    /** @test */
    public function itHasAddNewLink()
    {
        $this->assertSingleOccurrenceOf($this->page()->addNewLink());
    }

    /** @test */
    public function itHasEmptyTasksListIfNoTasksExists()
    {
        $this->assertSingleOccurrenceOf($this->page()->tasksTable());

        $this->assertCount(0, $this->page()->tasksRows());
    }

    /** @test */
    public function itDisplaysExistingTasks()
    {
        $this->tasksExists();

        $this->assertSingleOccurrenceOf($this->page()->tasksTable());

        $this->assertCount(2, $this->page()->tasksRows());
    }

    private function tasksExists()
    {
        $tagBackend = new Tag('backend');
        $tagFrontend = new Tag('frontend');
        $featureCategory = new Category('feature');
        $bugCategory = new Category('bug');

        $userManager = $this->container()->get('fos_user.user_manager');

        $user1 = $userManager->createUser();
        $user1
            ->setUsername('user1')
            ->setEmail('user@example.com')
            ->setPlainPassword('test123')
            ->setRoles(['ROLE_USER'])
            ->setEnabled(true);

        $user2 = $userManager->createUser();
        $user2
            ->setUsername('user2')
            ->setEmail('user2@example.com')
            ->setPlainPassword('test123')
            ->setRoles(['ROLE_USER'])
            ->setEnabled(true);

        $userManager->updateUser($user1);
        $userManager->updateUser($user2);

        $task1 = new Task();

        $task1->setName('example 1');
        $task1->setDescription('example description 1');
        $task1->setDueDate(new \DateTime());
        $task1->getTags()->add($tagBackend);
        $task1->getTags()->add($tagFrontend);
        $task1->setFile(new \SplFileObject(__FILE__));

        $task1->setCategory($featureCategory);
        $task1->setAssignedTo($user1);

        $task2 = new Task();

        $task2->setName('example 2');
        $task2->setDescription('example description 2');
        $task2->setDueDate(new \DateTime());
        $task2->getTags()->add($tagBackend);
        $task2->setFile(new \SplFileObject(__FILE__));

        $task2->setCategory($bugCategory);
        $task2->setAssignedTo($user2);

        $this->saveAll([
            $featureCategory,
            $bugCategory,
            $task1,
            $task2
        ]);
    }
}