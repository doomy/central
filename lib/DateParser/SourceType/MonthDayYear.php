<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\Definite;

class MonthDayYear extends SourceTypeWithSeparator {
    protected $expected_parts_amount = 3;

    public function check() {
        if(!parent::check()) return false;
        if (!DateParser::is_valid_day_number($this->parts[1])) return false;
        if (!DateParser::is_valid_month_number($this->parts[0])) return false;
        if (!DateParser::is_valid_year_number($this->parts[2])) return false;
        return true;
    }

    public function parse() {
        $this->day = $this->parts[1];
        $this->month = (int)$this->parts[0];
        $this->year = $this->parts[2];
        $this->certainty = new Definite();
    }
}

?> 