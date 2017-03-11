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
        $exampleTask = new Task();

        $exampleTask->setName('example');
        $exampleTask->setDescription('example description');
        $exampleTask->setDueDate(new \DateTime());
        $exampleTask->getTags()->add(new Tag('backend'));
        $exampleTask->getTags()->add(new Tag('frontend'));

        $exampleTask->setCategory($this->getReference('category-feature'));
        $exampleTask->setAssignedTo($this->getReference('user-user1'));

        $manager->persist($exampleTask);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}