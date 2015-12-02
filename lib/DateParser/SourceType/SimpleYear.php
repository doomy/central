<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\SourceType\SourceType;

use DateParser\Certainty\Ambiguous as AmbiguousCertainty;
use DateParser\Certainty\NotSpecific as NotSpecificCertainty;

class SimpleYear extends SourceType {
    public function check() {
        return DateParser::is_valid_year_number($this->raw_date);
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