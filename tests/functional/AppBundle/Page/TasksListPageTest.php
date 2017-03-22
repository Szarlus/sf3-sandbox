<?php

namespace tests\functional\AppBundle\Page;


use AppBundle\Entity\Category;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Task;
use tests\traits\DatabaseDictionary;
use tests\WebTestCase;

class TasksListPageTest extends WebTestCase
{

    use DatabaseDictionary;

    /** @var TasksListPage */
    private $page;

    protected function setUp()
    {
        parent::setUp();

        $this->page = null;

        $this->purgeDatabase();
    }

    /** @test */
    public function itHasAddNewLink()
    {
        $this->assertExists($this->page()->addNewLink());
    }

    /** @test */
    public function itHasEmptyTasksListIfNoTasksExists()
    {
        $this->assertExists($this->page()->tasksTable());

        $this->assertCount(0, $this->page()->tasksRows());
    }

    /** @test */
    public function itDisplaysExistingTasks()
    {
        $this->tasksExists();

        $this->assertExists($this->page()->tasksTable());

        $this->assertCount(2, $this->page()->tasksRows());
    }

    private function page()
    {
        if (!$this->page) {
            $this->page = new TasksListPage($this->client()->request('GET', '/task/list'));
        }

        return $this->page;
    }

    private function assertExists($node)
    {
        $this->assertCount(1, $node);
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