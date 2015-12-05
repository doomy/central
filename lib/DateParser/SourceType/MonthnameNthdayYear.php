<?php

namespace DateParser\SourceType;

use DateParser;


class MonthnameNthdayYear extends MonthnameDayYear {
    public function check() {
        if (!$this->separator) return false;
        $this->parts[1] = DateParser::get_day_from_nth_day($this->parts[1]);
        $result = parent::check();
        return $result;
    }
}

?> 