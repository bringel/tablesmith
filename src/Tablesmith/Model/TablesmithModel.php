<?php

namespace Tablesmith\Model;

use Tablesmith\Model\Table;

class TablesmithModel {
  public $tables;

  function __construct() {
    $this->tables = array();
  }

  static function fromJson(Array $data) {
    $tablesmith = new TablesmithModel();

    foreach($data as $tableData) {
      $t = Table::fromJson($tableData);
      array_push($tablesmith->tables, $t);
    }

    return $tablesmith;
  }

  function getOrderFromDependencies() {
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
          return 1;
        }
        else {
          return -1;
        }
    });

    return $tableNames;
  }
}
