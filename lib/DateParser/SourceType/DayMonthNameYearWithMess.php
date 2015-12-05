<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\SourceType\DayMonthnameYear;
use DateParser\Certainty\Likely;
use DateParser\Certainty\Ambiguous;


class DayMonthNameYearWithMess extends DayMonthnameYear {
    private $ambiguous = false;

    public function check() {
        if (!$this->separator) return false;
        if (DateParser::contains_ambiguous_keyword($this->raw_date)) {
            $this->ambiguous = true;
        }
        $month_name = DateParser::contains_a_month_name($this->parts);
        if (!$month_name) return false;
        $this->parts = DateParser::strip_invalid_parts($this->parts);
        return parent::check();
    }

    public function parse() {
        parent::parse();
        if ($this->ambiguous)
            $this->certainty = new Ambiguous();
        else
            $this->certainty = new Likely();
    }
}

?> 