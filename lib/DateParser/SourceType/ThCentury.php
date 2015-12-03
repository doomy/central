<?php

namespace DateParser\SourceType;

use DateParser\SourceType\SimpleYear;

use DateParser\Certainty\Ambiguous as AmbiguousCertainty;


class ThCentury extends SimpleYear {
    public function check() {
        $pos = strpos($this->raw_date, "th-century");
        if (!$pos) return false;

        $this->raw_date = str_replace("th-century", "", $this->raw_date);   // 16th-century => 16
        $this->raw_date .= '00';                                            // 16 => 1600
        return parent::check();
    }

    protected function determine_certainty() {
        return new AmbiguousCertainty();
    }
}

?> 