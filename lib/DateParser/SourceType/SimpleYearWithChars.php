<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\SourceType\SimpleYear;
use DateParser\Certainty\Ambiguous;
use StringTools;

class SimpleYearWithChars extends SimpleYear{
    private $original_raw_date;

    public function check() {
        $this->original_raw_date = $this->raw_date;
        $this->raw_date = StringTools::remove_nonnumeric_characters($this->raw_date);
        return parent::check();
    }

    public function parse() {
        parent::parse();
        if (DateParser::contains_ambiguous_keyword($this->original_raw_date))
            $this->certainty = new Ambiguous();
    }

}

?> 