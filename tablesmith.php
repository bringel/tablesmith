#!/usr/bin/env php

<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Tablesmith\Commands\AddCommand;

$app = new Application('Tablesmith', '0.1.0');

$addCommand = new AddCommand();

$app->add($addCommand);

$app->setDefaultCommand($addCommand->getName());
$app->run();
