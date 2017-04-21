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

  }
}
