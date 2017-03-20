<?php


namespace fixtures;


use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategories extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $feature = new Category('feature');
        $bug = new Category('bug');

        $manager->persist($feature);
        $manager->persist($bug);

        $manager->flush();

        $this->addReference('category-feature', $feature);
        $this->addReference('category-bug', $bug);
    }

    public function getOrder()
    {
        return 1;
    }
}