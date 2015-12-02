<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\Definite as DefiniteCertainty;

class MwordSpaceDayCommaSpaceYear extends SourceType {
    public function check() {
        $parts = explode(" ", $this->raw_date);
        if (count($parts) != 3) return false;

        $parts[1] = str_replace(',', '', $parts[1]);
        if (!DateParser::is_valid_day_number($parts[1])) return false;
        if (!DateParser::is_month_name($parts[0])) return false;
        if (!DateParser::is_valid_year_number($parts[2])) return false;

        return true;
    }

    public function parse() {
        $parts = explode(" ", $this->raw_date);
        $parts[1] = str_replace(',', '', $parts[1]);

        $this->day = $parts[1];
        $this->month = DateParser::get_month_number($parts[0]);
        $this->year = $parts[2];
        $this->certainty = new DefiniteCertainty();
    }
}

?> 