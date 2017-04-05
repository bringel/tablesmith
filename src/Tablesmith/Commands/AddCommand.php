<?php

namespace Tablesmith\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends Command {

  protected function configure() {
    $this->setName('add')
         ->setDescription('Starts the insert process for this file or directory');
  }
}
