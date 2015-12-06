<?php

namespace base;

use Environment;

abstract class DbCall {
    protected $mysqli;

    public function __construct($dbh) {
        $this->mysqli = $dbh->get_mysqli_connection();
    }

}

?> 