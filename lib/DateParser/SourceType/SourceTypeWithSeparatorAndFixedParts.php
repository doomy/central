<?php

namespace DateParser\SourceType;

use DateParser;

abstract class SourceTypeWithSeparatorAndFixedParts extends SourceTypeWithSeparator {
    protected $expected_parts_amount;

    public function check() {
        if(!$this->separator) return false;
        if (count($this->parts) != $this->expected_parts_amount) return false;
        return true;
    }
}

?> 