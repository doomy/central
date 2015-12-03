<?php

namespace DateParser\SourceType;

use DateParser;

use DateParser\Certainty\NotSpecific;

class ShortMonthYear extends SourceType {
    public function check() {
        $parts = explode(" ", $this->raw_date);
        if (count($parts) != 2) return false;
        if (!DateParser::is_short_month_name($parts[0])) return false;
        if (!DateParser::is_valid_year_number($parts[1])) return false;
        return true;
    }

    public function parse() {
        $parts = explode(" ", $this->raw_date);
        $this->month = DateParser::get_short_month_number($parts[0]);
        $this->year = $parts[1];
        $this->certainty = new NotSpecific();
    }

}

?> 