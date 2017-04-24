<?php

namespace Tablesmith\Model;

use Tablesmith\Model\Column;

class Table {
  public $name;
  public $columns;
  public $data;

  function __construct() {
    $this->columns = array();
    $this->data = array();
  }

  static function fromJson(Array $data) {
    $t = new Table();

    $tableMetadata = $data["table"];
    $tableData = $data["data"];

    $t->name = $tableMetadata["tableName"];
    $t->data = $tableData;

    foreach($tableMetadata["columns"] as $columnData) {
      $c = Column::fromJson($columnData);
      array_push($t->columns, $c);
    }

    return $t;
  }

  function getDependencies() {
    $deps = array();
    foreach($this->columns as $c) {
      if ($c->linkToTableName) {
        array_push($deps, $c->linkToTableName);
      }
    }

    $deps = array_unique($deps);
    return $deps;
  }
}
