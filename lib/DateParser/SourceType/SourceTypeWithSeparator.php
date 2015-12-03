<?php

namespace DateParser\SourceType;


abstract class SourceTypeWithSeparator extends SourceType {
    protected $separator;
    protected $expected_parts_amount;
    protected $parts;

    public function __construct($raw_date) {
        parent::__construct($raw_date);
        $this->separator = $this->get_separator();
    }

    public function check() {
        if(!$this->separator) return false;
        $this->parts = explode($this->separator, $this->raw_date);
        if (count($this->parts) != $this->expected_parts_amount) return false;
        return true;
    }

    protected function get_separator() {
        $dash_position = strpos($this->raw_date, '-');
        $slash_position = strpos($this->raw_date, '/');
        if (!$dash_position && !$slash_position) return false;
        if ($dash_position && $slash_position) return false;
        return $dash_position ? '-' : '/';
    }

}

?> 