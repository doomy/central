<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\SourceType\SourceTypeWithSeparator;
use DateParser\Certainty\Ambiguous;

class NthCenturyWithMess extends SourceTypeWithSeparator {
    protected $separator_subset = array(" ");

    public function check() {
        if (!strpos(strtolower($this->raw_date), 'century')) return false;
        if (!$this->separator) return false;
        $year = DateParser::get_nth_number($this->parts[0]) . '00';
        return DateParser::is_valid_year_number($year);
    }

    public function parse() {
        $this->year = DateParser::get_nth_number($this->parts[0]) . '00';
        $this->certainty = new Ambiguous();
    }
}

?> 