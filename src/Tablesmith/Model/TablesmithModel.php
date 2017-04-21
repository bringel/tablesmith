<?php

namespace Tablesmith\Model;

use Tablesmith\Model\Table;

class TablesmithModel {
  public $tables;

  function __construct() {
    $this->$tables = array();
  }

  static function fromJson(Array $data) {
    var_dump($data);
  }
}
