<?php

namespace DateParser\SourceType;


abstract class SourceType {
    protected $day;
    protected $month;
    protected $year;
    protected $bc = false;
    protected $certainty;
    protected $raw_date;

    public function __construct($raw_date) {
        $this->raw_date = $raw_date;
    }

    public function get_string_representation() {
        if ($this->day && $this->month && $this->year)
            $output = "{$this->day}.{$this->month}.{$this->year}";
        else if ($this->year && $this->month)
            $output = $this->year . "/" . $this->month;
        else if ($this->year)
            $output = $this->year;
        if ($this->bc) $output .= " BC";
        return $output;
    }

    public function get_certainty() {
        return $this->certainty;
    }

    abstract public function check();
}

?> 