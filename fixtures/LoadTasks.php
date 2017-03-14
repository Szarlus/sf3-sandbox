<?php


namespace Fixtures;


use AppBundle\Entity\Tag;
use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTasks extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tagBackend = new Tag('backend');
        $tagFrontend = new Tag('frontend');

        $task1 = new Task();

        $task1->setName('example 1');
        $task1->setDescription('example description 1');
        $task1->setDueDate(new \DateTime());
        $task1->getTags()->add($tagBackend);
        $task1->getTags()->add($tagFrontend);
        $task1->setFile(new \SplFileObject(__FILE__));

        $task1->setCategory($this->getReference('category-feature'));
        $task1->setAssignedTo($this->getReference('user-user1'));

        $task2 = new Task();

        $task2->setName('example 2');
        $task2->setDescription('example description 2');
        $task2->setDueDate(new \DateTime());
        $task2->getTags()->add($tagBackend);
        $task2->setFile(new \SplFileObject(__FILE__));

        $task2->setCategory($this->getReference('category-feature'));
        $task2->setAssignedTo($this->getReference('user-user1'));

        $manager->persist($task1);
        $manager->persist($task2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}