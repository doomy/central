<?php

namespace DateParser\Certainty;

use DateParser\Certainty\Certainty;


class Unknown extends Certainty {
    protected $string_representation = 'Unknown';

    public function check($raw_date) {
        return true;
    }
}

?> 