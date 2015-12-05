<?php

namespace DateParser\SourceType;

use DateParser;

abstract class SourceTypeWithSeparator extends SourceType {
    protected $separator;
    protected $expected_parts_amount;
    protected $parts;

    public function __construct($raw_date) {
        parent::__construct($raw_date);
        $this->separator = $this->get_separator();
        if (!$this->separator) return false;
        $this->parts = explode($this->separator, $this->raw_date);
    }

    public function check() {
        if(!$this->separator) return false;
        if (count($this->parts) != $this->expected_parts_amount) return false;
        return true;
    }

    protected function get_separator() {
        return DateParser::find_separator_from_subset(array('-', '/'), $this->raw_date);
    }
}

?> 