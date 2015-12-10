<?php

namespace DateParser\Certainty;


abstract class Certainty {
    protected $string_representation;
    protected $id;

    public function get_string_representation() {
        return $this->string_representation;
    }

    public function get_db_id() {
        return $this->id;
    }
}

?> 