<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\NotSpecific as NotSpecificCertainty;


class YearMonth extends SourceTypeWithSeparator {
    protected $expected_parts_amount = 2;

    public function check() {
        if (!parent::check()) return false;
        if (!DateParser::is_valid_month_number($this->parts[1])) return false;
        if (!DateParser::is_valid_year_number($this->parts[0])) return false;
        return true;
    }

    public function parse() {
        $this->month = $this->parts[1];
        $this->year = $this->parts[0];
        $this->certainty = new NotSpecificCertainty();
    }
}

?> 