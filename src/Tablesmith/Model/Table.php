<?php

namespace Tablesmith\Model;

use Tablesmith\Model\Column;

class Table {
  public $columns;
  public $data;

  function __construct() {
    $this->$columns = array();
    $this->$data = array();
  }

  static function fromJson(Array $data) {

  }
}
