<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\Ambiguous;

class YearOrYear extends SourceType {
    public function check() {
        $parts = explode("/", $this->raw_date);
        if (count($parts) != 2) return false;
        if (!DateParser::is_valid_year_number($parts[0])) return false;
        if (!DateParser::is_valid_year_number($parts[1])) return false;
        return true;
    }

    public function parse() {
        $parts = explode("/", $this->raw_date);
        $this->year = $parts[0];
        $this->certainty = new Ambiguous();
    }

}

?> 