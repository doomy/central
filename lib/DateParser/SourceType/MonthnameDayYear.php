<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\Definite as DefiniteCertainty;

class MonthnameDayYear extends SourceTypeWithSeparatorAndFixedParts {
    protected $separator_subset = array(' ');
    protected $expected_parts_amount = 3;

    public function check() {
        if (!parent::check()) return false;

        if (!DateParser::is_valid_day_number($this->parts[1])) return false;
        if (!DateParser::is_month_name($this->parts[0])) return false;
        if (!DateParser::is_valid_year_number($this->parts[2])) return false;

        return true;
    }

    public function parse() {
        $this->day = $this->parts[1];
        $this->month = DateParser::get_month_number($this->parts[0]);
        $this->year = $this->parts[2];
        $this->certainty = new DefiniteCertainty();
    }
}

?> 