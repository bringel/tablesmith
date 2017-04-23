<?php

namespace Tablesmith\Model;

class Column {
  public $name;
  public $type;
  public $linkToTableName;
  public $linkType;
  public $linkToColumnName;

  function __construct() {
  }

  static function fromJson(Array $data) {
    $column = new Column();

    $column->name = $data["name"];
    $column->type = $data["type"];

    if (array_key_exists("linkTo", $data)){
      $column->linkToTableName = $data["linkTo"];
      $column->linkType = $data["linkType"];
      $column->linkToColumnName = $data["linkToColumn"];
    }

    return $column;
  }
}
