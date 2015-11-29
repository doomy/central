<?php

namespace base;

abstract class DbCall {
    protected $mysqli;

    public function __construct() {
        $dbh = Environment::get_dbh();
        $this->mysqli = $dbh->get_mysqli_object();
    }

}

?> 