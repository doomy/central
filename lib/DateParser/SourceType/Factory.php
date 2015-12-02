<?php

namespace DateParser\SourceType;

use DateParser\SourceType\Unknown;

class Factory {
    public static function get_sourcetype_object($source_date) {
        return new Unknown();
    }

}

?> 