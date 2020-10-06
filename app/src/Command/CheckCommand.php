<?php

namespace App\Command;

use App\Service\Check;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckCommand extends Command
{

    private Check $check;

    public function __construct(Check $check)
    {
        $this->check = $check;

        parent::__construct();
    }

    protected static $defaultName = 'app:check';

    protected function configure()
    {
        $this->setDescription('Check all sites');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->check->run();

        return 0;
    }

}
