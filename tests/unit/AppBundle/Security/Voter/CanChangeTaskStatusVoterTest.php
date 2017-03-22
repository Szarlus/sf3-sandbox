<?php

namespace tests\unit\AppBundle\Security\Voter;


use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use AppBundle\Security\Voter\CanChangeTaskStatusVoter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CanChangeTaskStatusVoterTest extends TestCase
{
    /** @var CanChangeTaskStatusVoter */
    private $voter;

    /** @var TokenInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $token;

    protected function setUp()
    {
        $this->token = $this->tokenMock();
        $this->voter = new CanChangeTaskStatusVoter();
    }

    /** @test */
    public function itAbstainsFromVotingIfSubjectIsNotATask()
    {
        $this->assertSame(Voter::ACCESS_ABSTAIN, $this->voter->vote(
            $this->token,
            new \stdClass(),
            ['change_status']
        ));
    }

    /** @test */
    public function itAbstainsFromVotingIfAttributeIsNotStatusChange()
    {
        $this->assertSame(Voter::ACCESS_ABSTAIN, $this->voter->vote(
            $this->token,
            new Task(),
            ['something']
        ));
    }

    /** @test */
    public function itDeniesAccessIfThereIsNoUserToVoteFor()
    {
        $this->tokenWithoutUser();

        $this->assertSame(Voter::ACCESS_DENIED, $this->voter->vote(
            $this->token,
            new Task(),
            ['change_status']
        ));
    }

    /** @test */
    public function itDeniesAccessIfUserIsNotAssignedToTheTask()
    {
        $task = new Task();
        $this->tokenReturns(new User());

        $this->assertSame(Voter::ACCESS_DENIED, $this->voter->vote(
            $this->token,
            $task,
            ['change_status']
        ));
    }

    /** @test */
    public function itGrantsAccessIfUserIsAssignedToTheTask()
    {
        $user = new User();
        $task = new Task();
        $task->setAssignedTo($user);
        $this->tokenReturns($user);

        $this->assertSame(Voter::ACCESS_GRANTED, $this->voter->vote(
            $this->token,
            $task,
            ['change_status']
        ));
    }

    private function tokenMock()
    {
        return $this
            ->getMockBuilder(TokenInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function tokenReturns($user)
    {
        $this->token
            ->expects($this->any())
            ->method('getUser')
            ->willReturn($user);
    }

    private function tokenWithoutUser()
    {
        $this->tokenReturns(null);
    }
}
