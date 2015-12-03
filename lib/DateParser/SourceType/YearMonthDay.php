<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\Likely;

class YearMonthDay extends SourceType{
    private $separator;

    public function __construct($raw_date) {
        parent::__construct($raw_date);
        $this->separator = $this->get_separator();
    }

    public function check() {
        if(!$this->separator) return false;
        $parts = explode($this->separator, $this->raw_date);
        if (count($parts) != 3) return false;
        if (!DateParser::is_valid_day_number($parts[2])) return false;
        if (!DateParser::is_valid_month_number($parts[1])) return false;
        if (!DateParser::is_valid_year_number($parts[0])) return false;
        return true;
    }

    public function parse() {
        $parts = explode($this->separator, $this->raw_date);
        $this->day = $parts[2];
        $this->month = $parts[1];
        $this->year = $parts[0];
        $this->certainty = new Likely();
    }

    private function get_separator() {
        $dash_position = strpos($this->raw_date, '-');
        $slash_position = strpos($this->raw_date, '/');
        if (!$dash_position && !$slash_position) return false;
        if ($dash_position && $slash_position) return false;
        return $dash_position ? '-' : '/';
    }

}

?> 