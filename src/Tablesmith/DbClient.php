<?php

namespace Tablesmith;

use Tablesmith\Model\TablesmithModel;

class DbClient {

  private $model;

  function __construct(TablesmithModel $model) {
    $this->model = $model;
  }

  private function getOrderFromDependencies() {
    $tableNames = array_map(function($t) {
      return $t->name;
    }, $this->tables);
    $deps = array();

    foreach($this->tables as $t) {
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
