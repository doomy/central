<?php

namespace base;

abstract class DbCall {
    protected $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

}

?> 