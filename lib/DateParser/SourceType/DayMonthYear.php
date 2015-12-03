<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\Likely;
use DateParser\Certainty\Definite;


class DayMonthYear extends SourceTypeWithSeparator {
    protected $expected_parts_amount = 3;

    public function check() {
        if(!parent::check()) return false;
        if (!DateParser::is_valid_day_number($this->parts[0])) return false;
        if (!DateParser::is_valid_month_number($this->parts[1])) return false;
        if (!DateParser::is_valid_year_number($this->parts[2])) return false;
        return true;
    }

    public function parse() {
        $this->day = $this->parts[0];
        $this->month = (int)$this->parts[1];
        $this->year = $this->parts[2];
        if (DateParser::is_day_number_for_sure($this->day))
            $this->certainty = new Definite();
        else
            $this->certainty = new Likely();
    }

}

?> 