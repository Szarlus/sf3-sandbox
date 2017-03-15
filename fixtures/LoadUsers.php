<?php


namespace Fixtures;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class LoadUsers extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $admin = $userManager->createUser();
        $admin
            ->setUsername('admin')
            ->setEmail('admin@example.com')
            ->setPlainPassword('test123')
            ->setRoles(['ROLE_ADMIN'])
            ->setEnabled(true);

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

        $userManager->updateUser($admin);
        $userManager->updateUser($user1);
        $userManager->updateUser($user2);

        $this->addReference('user-user1', $user1);
    }

    public function getOrder()
    {
        return 1;
    }
}