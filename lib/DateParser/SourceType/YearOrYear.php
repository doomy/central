<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\Certainty\Ambiguous;

class YearOrYear extends SourceTypeWithSeparatorAndFixedParts {
    protected $expected_parts_amount = 2;
    protected $separator_subset = array('/');

    public function check() {
        parent::check();
        if (!DateParser::is_valid_year_number($this->parts[0])) return false;
        if (!DateParser::is_valid_year_number($this->parts[1])) return false;
        return true;
    }

    public function parse() {
        $this->year = $this->parts[0];
        $this->certainty = new Ambiguous();
    }
}

?> 