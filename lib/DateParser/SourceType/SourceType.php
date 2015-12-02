<?php

namespace DateParser\SourceType;


abstract class SourceType {
    protected $day = 1;
    protected $month = 1;
    protected $year;
    protected $bc = false;
    protected $certainty;
    protected $raw_date;

    public function __construct($raw_date) {
        $this->raw_date = $raw_date;
    }

    public function get_string_representation() {
        $output = "{$this->day}.{$this->month}.{$this->year}";
        if ($this->bc) $output .= " BC";
        return $output;
    }

    public function get_certainty() {
        return $this->certainty;
    }

    abstract public function check();
}

?> 