<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use bilibili\raichu\engine\App;

class ArchiveCommand extends Command
{
    protected $memcached;

    protected function configure()
    {
        $this->setName('archive:update')->setDescription('运营后台例行更新命令');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return 'TODO ... hi, ___Danko!';
    }
}