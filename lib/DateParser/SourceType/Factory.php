<?php

namespace DateParser\SourceType;

class Factory {
    private function get_sourcetype_classes() {
        return array('YearMonthDay', 'YearMonth','MwordSpaceDayCommaSpaceYear', 'DaySpaceMwordSpaceYear', 'SimpleYearBC', 'SimpleYearWithChars', 'SimpleYear', 'Unknown');
    }

    public static function get_sourcetype_object($raw_date) {
        $raw_date = trim($raw_date);
        $raw_date_escaped = addslashes($raw_date);

        foreach (self::get_sourcetype_classes() as $class) {
            $source_type = eval("
                use DateParser\\SourceType\\$class;
                return new $class('$raw_date_escaped');
            ");
            if ($source_type->check()) {
               return $source_type;
            }
        }
        return new Unknown();
    }
}

?> 