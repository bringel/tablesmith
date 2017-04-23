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
}
