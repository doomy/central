<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\NotSpecific;

class MonthNameYear extends SourceTypeWithSeparatorAndFixedParts {
    protected $separator_subset = array(" ");
    protected $expected_parts_amount = 2;

    public function check() {
        parent::check();
        if (!DateParser::is_month_name($this->parts[0])) return false;
        if (!DateParser::is_valid_year_number($this->parts[1])) return false;
        return true;
    }

    public function parse() {
        $this->month = DateParser::get_month_number($this->parts[0]);
        $this->year = $this->parts[1];
        $this->certainty = new NotSpecific();
    }
}

?> 