<?php

namespace DateParser\SourceType;

use DateParser\Certainty\Unknown as UnknownCertainty;

class SimpleYear extends SourceType {
    public function check() {
        $only_numbers  = ctype_digit($this->raw_date);
        return ($only_numbers && (strlen($this->raw_date)<=4));
    }

    public function parse() {

        $this->certainty = new UnknownCertainty();
        $this->year = $this->raw_date;
    }
}

?> 