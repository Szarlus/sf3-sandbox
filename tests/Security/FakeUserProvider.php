<?php

namespace tests\Security;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FakeUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->getUser($username);
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->getUser($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === User::class;
    }

    private function getUser($username)
    {
        $userRoles = [
            'admin' => ['ROLE_ADMIN']
        ];

        if (!isset($userRoles[$username])) {
            throw new UsernameNotFoundException("user $username does not exist");
        }

        $user = new User();
        $user->setUsername($username);
        $user->setRoles($userRoles[$username]);
        $user->setPassword('P@ssw0rd');
        $user->setEnabled(true);

        return $user;
    }
}