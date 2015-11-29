<?php

namespace base;

use Environment;

abstract class DbController extends Controller {
    protected $dbh;

    public function __construct() {
        $this->dbh = Environment::get_dbh();
        parent::__construct();
    }

}

?> 