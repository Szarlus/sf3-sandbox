<?php

namespace AppBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DoYouWantMeToProceedCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:do-you-want-me-to-proceed');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}