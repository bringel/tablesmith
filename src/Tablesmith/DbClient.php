<?php

namespace Tablesmith;

use Tablesmith\Model\TablesmithModel;

class DbClient {

  private $model;

  function __construct(TablesmithModel $model) {
    $this->model = $model;
  }

}
