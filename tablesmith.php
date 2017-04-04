<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$app = new Application('Tablesmith', '0.1.0');

$app->run();
