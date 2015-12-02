<?php

namespace DateParser\Certainty;


abstract class Certainty {
    protected $string_representation;

    public function get_string_representation() {
        return $this->string_representation;
    }
}

?> 