<?php

namespace DateParser\SourceType;

use DateParser\SourceType\SimpleYear;
use DateParser\Certainty\Ambiguous;
use StringTools;

class SimpleYearWithChars extends SimpleYear{
    private $ambiguous_keywords = array("circa", "around", "about", "late", "early", "before", "after");
    private $original_raw_date;

    public function check() {
        $this->original_raw_date = $this->raw_date;
        $this->raw_date = StringTools::remove_nonnumeric_characters($this->raw_date);
        return parent::check();
    }

    public function parse() {
        parent::parse();
        if ($this->is_ambiguous())
            $this->certainty = new Ambiguous();
    }

    private function is_ambiguous() {
        //\Environment::var_dump($this->original_raw_date, 'original raw date');
        $raw_date_lower = strtolower($this->original_raw_date);
        foreach ($this->ambiguous_keywords as $keyword) {
            if (strpos($raw_date_lower, $keyword) > -1 ) return true;
        }
        return false;
    }
}

?> 