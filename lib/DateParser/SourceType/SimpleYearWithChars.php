<?php

namespace DateParser\SourceType;

use DateParser\SourceType\SimpleYear;
use StringTools;

class SimpleYearWithChars extends SimpleYear{
    public function check() {
        $this->raw_date = StringTools::remove_nonnumeric_characters($this->raw_date);
        return parent::check();
    }

}

?> 