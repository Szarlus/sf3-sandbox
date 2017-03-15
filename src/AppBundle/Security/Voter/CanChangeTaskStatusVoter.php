<?php

namespace AppBundle\Security\Voter;


use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CanChangeTaskStatusVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return $subject instanceof Task && $attribute == 'change_status';
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }
        /** @var $subject Task */
        return $subject->getAssignedTo() == $user;
    }
}