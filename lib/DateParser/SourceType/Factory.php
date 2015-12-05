<?php

namespace DateParser\SourceType;

class Factory {
    private function get_sourcetype_classes() {
        return array(
            'YearMonthDay', 'YearMonth', 'DayMonthYear',
            'YearDayMonth', 'MonthDayYear',
            'MonthnameDayYear', 'DayMonthnameYear', 'DayMonthNameYearWithMess',
            'MonthnameNthdayYear',
            'ShortMonthYear', 'MonthNameYear',
            'ThCentury', 'YearOrYear',
            'SimpleYearBC', 'SimpleYearWithChars', 'SimpleYear',
            'Unknown'
        );
    }

    public static function get_sourcetype_object($raw_date) {
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
    }
}

?> 