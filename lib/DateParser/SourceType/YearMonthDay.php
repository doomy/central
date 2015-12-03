<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\Likely;
use DateParser\Certainty\Definite;
use DateParser\SourceType\YearMonth;

class YearMonthDay extends YearMonth {
    protected $expected_parts_amount = 3;

    public function check() {
        if (!parent::check()) return false;
        if (!DateParser::is_valid_day_number($this->parts[2])) return false;
        return true;
    }

    public function parse() {
        parent::parse();
        $this->day = $this->parts[2];
        if (DateParser::is_day_number_for_sure($this->day))
            $this->certainty = new Definite();
        else
            $this->certainty = new Likely();
    }
}

?> 