<?php

namespace tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

abstract class CliTestCase extends IntegrationTestCase
{
    /** @var CommandTester */
    private $tester;

    protected function executeCommand(Command $command, array $parameters = [])
    {
        $application = new Application($this->container()->get('kernel'));
        $application->add($command);

        $this->tester = new CommandTester($command);

        $parameters = array_merge(
            ['command' => $command->getName()],
            $parameters
        );

        $this->tester->execute($parameters);
    }

    protected function assertCliExitCodeEquals($expectedExitCode)
    {
        $this->assertEquals($expectedExitCode, $this->tester->getStatusCode());
    }
}
