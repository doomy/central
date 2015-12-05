<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\SourceType\DayMonthnameYear;
use DateParser\Certainty\Likely;


class DayMonthNameYearWithMess extends DayMonthnameYear {
    public function check() {
        //\Environment::var_dump($this->raw_date, 'raw_date');
        if (!$this->separator) return false;
        $month_name = DateParser::contains_a_month_name($this->parts);
        if (!$month_name) return false;
        $this->parts = $this->strip_illegal_parts($this->parts);
        //\Environment::var_dump($this->parts, 'stripped parts');
        return parent::check();
    }

    private function strip_illegal_parts($parts) {
        $stripped_parts = array();
        foreach($parts as $part) {
            $part = str_replace(',', '', $part);
            if (ctype_digit($part) || DateParser::is_valid_month_name($part))
                $stripped_parts[] = $part;
        }
        return $stripped_parts;
    }

    public function parse() {
        parent::parse();
        $this->certainty = new Likely();
    }
}

?> 