<?php

namespace DateParser\SourceType;
use DateParser\Certainty\NotSpecific as NotSpecificCertainty;


class SimpleYearBC extends SimpleYearWithChars {
    public function check() {
        if (strpos($this->raw_date, ' BCE'))
            $this->raw_date = str_replace(' BCE', '', $this->raw_date);
        elseif (strpos($this->raw_date, ' BC'))
            $this->raw_date = str_replace(' BC', '', $this->raw_date);
        elseif ($this->raw_date[0] == '-')
            $this->raw_date = substr($this->raw_date, 1);
        else return false;

        $this->raw_date = trim($this->raw_date);
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