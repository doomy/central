<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\SourceType\DayMonthnameYear;
use DateParser\Certainty\Likely;


class DayMonthNameYearWithMess extends DayMonthnameYear {
    public function check() {
        if (!$this->separator) return false;
        $month_name = DateParser::contains_a_month_name($this->parts);
        if (!$month_name) return false;
        $this->parts = DateParser::strip_invalid_parts($this->parts);
        return parent::check();
    }

    public function parse() {
        parent::parse();
        $this->certainty = new Likely();
    }
}

?> 