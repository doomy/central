<?php

namespace DateParser\SourceType;

use DateParser\SourceType\MonthnameDayYear;

class MonthnameDayYearBC extends MonthnameDayYear {
    protected $expected_parts_amount = 4;

    public function check() {
        if (!parent::check()) return false;
        if ($this->parts[3] != 'BC') return false;
        return true;
    }

    public function parse() {
        parent::parse();
        $this->bc = true;
    }

}

?> 