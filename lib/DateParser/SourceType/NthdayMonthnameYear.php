<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\SourceType\DayMonthnameYear;

class NthdayMonthnameYear extends DayMonthnameYear {
    public function check() {
        if (!$this->separator) return false;
        $this->parts[0] = DateParser::get_day_from_nth_day($this->parts[0]);
        return parent::check();
    }

}

?> 