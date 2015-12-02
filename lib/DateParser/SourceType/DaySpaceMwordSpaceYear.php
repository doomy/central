<?php

namespace DateParser\SourceType;


class DaySpaceMwordSpaceYear extends SourceType {
    public function check() {
        $parts = explode(" ", $this->raw_date);
    }
}

?> 