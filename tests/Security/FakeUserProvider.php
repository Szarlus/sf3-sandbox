<?php

namespace tests\Security;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FakeUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        var_dump(__METHOD__, $username);die;
        return $this->getAdmin();
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->getAdmin();
    }

    public function supportsClass($class)
    {
        return true;
    }

    private function getAdmin()
    {
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);

        return $admin;
    }
}