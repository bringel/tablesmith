<?php

namespace Tablesmith;

use Tablesmith\Model\TablesmithModel;
use Aura\Sql\ExtendedPdo;

class DbClient {

  private $model;
  private $db;

  function __construct(TablesmithModel $model, string $connectionString) {
    $this->model = $model;
    $this->db = new ExtendedPdo($connectionString);
  }

  private function getOrderFromDependencies() {
    $tableNames = array_map(function($t) {
      return $t->name;
    }, $this->model->tables);
    $deps = array();

    foreach($this->model->tables as $t) {
      $tableDeps = $t->getDependencies();
      $deps[$t->name] = $tableDeps;
    }


    usort($tableNames, function($one, $two) use ($deps){
        $tableDeps = $deps[$two];

        if(array_search($one, $tableDeps) === false){
          // if $one is not in $two's dependencies, then it can go after in the order`
          return 1;
        }
        else {
          // if we found $one in $two's dependencies, make sure that table is inserted first
          return -1;
        }
    });

    return $tableNames;
  }
}
