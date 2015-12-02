<?php

namespace DateParser\SourceType;
use DateParser\Certainty\NotSpecific as NotSpecificCertainty;


class SimpleYearBC extends SimpleYear {
    public function check() {
        if (!strpos($this->raw_date, ' BC')) return false;

        $this->raw_date = trim(str_replace(' BC', '', $this->raw_date));
        $result = parent::check();
        return $result;
    }

    public function parse() {
        parent::parse();
        $this->certainty = new NotSpecificCertainty();
        $this->bc = true;
    }
}

?> 