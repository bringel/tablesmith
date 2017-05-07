<?php

namespace Tablesmith\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use \PDO;

use Tablesmith\Model\TablesmithModel;
use Tablesmith\DbClient;



class AddCommand extends Command {

  protected function configure() {
    $this->setName('add')
         ->setDescription('Start adding records to your database')
         ->addArgument('connectionString', InputArgument::REQUIRED, 'Connection string to your database')
         ->addArgument('filePath', InputArgument::REQUIRED, 'File or directory where your insert files are')
         ->addOption('directory', 'd', InputOption::VALUE_NONE, 'If you are passing in a directory of files instead of one file');
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $data = $this->readFileData($input->getArgument('filePath'), $input->getOption('directory'), $output);

    $tablesmithModel = TablesmithModel::fromJson($data);
    $dbClient = new DbClient($tablesmithModel, $input->getArgument('connectionString'));
  }

  private function readFileData(string $filePath, bool $directory, OutputInterface $output){

    $data = array();

    $currentDir = getcwd();
    $inputDir = $filePath;

    $path = $currentDir . '/' . $inputDir;
    $path = realpath($path);
    if ($directory) {
      if (!is_dir($path)) {
        $output->writeln('<error>-d option requires a directory name, not a file name</error>');
        return;
      }
      $fileNames = scandir($path);
      $fileContents = array();

      foreach($fileNames as $f) {
        if(!is_dir($path.'/'.$f)) {
          array_push($fileContents, file_get_contents($path.'/'.$f));
        }
      }
      $data = array_merge($data, $fileContents);
    }
    else {
      $contents = file_get_contents($path);
      array_push($data, $contents);
    }

    $data = array_map(function($json) {
      return json_decode($json, true);
    }, $data);

    return $data;
  }
}
