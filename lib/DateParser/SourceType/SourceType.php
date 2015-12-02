<?php

namespace DateParser\SourceType;


abstract class SourceType {
    protected $day;
    protected $month;
    protected $year;
    protected $bc = false;
    protected $certainty;

    public function get_text_representation() {
        return "$day.$month.$year";
    }

    public function get_certainty() {
        return $this->certainty;
    }

    abstract public function parse();

    abstract public function check($raw_date);
}

?> 