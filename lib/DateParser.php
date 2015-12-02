<?php

use DateParser\Sampler;
use DateParser\SourceType\Unknown;

class DateParser {

    public function render_sampler() {
        $sampler = new Sampler();
        return $sampler->render();
    }

    public static function parse_date($source_date) {
        $result = new stdClass();

        $parse_object = new Unknown();
        $parse_object->parse();
        $result->original = $source_date;
        $result->parsed = $parse_object->get_string_representation();
        $result->certainty = $parse_object->get_certainty();
        return $result;
    }
}

?> 