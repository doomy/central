<?php

namespace DateParser\SourceType;

use DateParser\SourceType\SourceType;
use DateParser\Certainty\Unknown as UnknownCertainty;


class Unknown extends SourceType {
    public function parse() {
        $this->certainty = new UnknownCertainty();
    }

    public function check() {
        return true;
    }

    public function get_string_representation() {
        return 'unknown';
    }
}

?> 