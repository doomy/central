<?php

namespace DateParser\SourceType;

use DateParser\SourceType\SourceType;

use DateParser\Certainty\Ambiguous as AmbiguousCertainty;
use DateParser\Certainty\NotSpecific as NotSpecificCertainty;

class SimpleYear extends SourceType {
    public function check() {
        $only_numbers  = ctype_digit($this->raw_date);
        return ($only_numbers && (strlen($this->raw_date)<=4));
    }

    public function parse() {
        $this->certainty = $this->determine_certainty();
        $this->year = $this->raw_date;
    }

    protected function determine_certainty() {
        if (strlen($this->raw_date)==4)
            return new NotSpecificCertainty();

        return new AmbiguousCertainty();
    }
}

?> 