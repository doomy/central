<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\NotSpecific as NotSpecificCertainty;


class YearMonth extends SourceType {
    protected $separator;
    protected $parts;
    protected $expected_parts_amount = 2;

    public function __construct($raw_date) {
        parent::__construct($raw_date);
        $this->separator = $this->get_separator();
    }

    public function check() {

        if(!$this->separator) return false;
        $this->parts = explode($this->separator, $this->raw_date);
        if (count($this->parts) != $this->expected_parts_amount) return false;
        if (!DateParser::is_valid_month_number($this->parts[1])) return false;
        if (!DateParser::is_valid_year_number($this->parts[0])) return false;
        return true;
    }

    protected function get_separator() {
        $dash_position = strpos($this->raw_date, '-');
        $slash_position = strpos($this->raw_date, '/');
        if (!$dash_position && !$slash_position) return false;
        if ($dash_position && $slash_position) return false;
        return $dash_position ? '-' : '/';
    }

    public function parse() {
        $this->month = $this->parts[1];
        $this->year = $this->parts[0];
        $this->certainty = new NotSpecificCertainty();
    }
}

?> 