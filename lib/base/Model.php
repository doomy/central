<?php

namespace base;

abstract class Model {
    protected $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }
}

?> 