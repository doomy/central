<?php

namespace DateParser\SourceType;

use DateParser;
use DateParser\SourceType\SourceType;


abstract class SourceTypeWithSeparator extends SourceType {
    protected $separator;
    protected $parts;
    protected $separator_subset = array('-', '/');

    public function __construct($raw_date) {
        parent::__construct($raw_date);
        $this->separator = $this->get_separator();
        if (!$this->separator) return false;
        $this->parts = explode($this->separator, $this->raw_date);
    }

    protected function get_separator() {
        return DateParser::find_separator_from_subset($this->separator_subset, $this->raw_date);
    }
}

?> 