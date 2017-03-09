<?php


namespace Fixtures;


use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategories implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $feature = new Category('feature');
        $bug = new Category('bug');

        $manager->persist($feature);
        $manager->persist($bug);

        $manager->flush();
    }
}