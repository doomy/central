<?php

use DateParser\Sampler;
use DateParser\Certainty\Unknown;

class DateParser {

    public function render_sampler() {
        $sampler = new Sampler();
        return $sampler->render();
    }

    public static function parse_date($source_date) {
        $result = new stdClass();

        $certainty = new Unknown();
        $result->original = $source_date;
        $result->parsed = 'unknown';
        $result->certainty = $certainty;
        return $result;
    }
}

?> 