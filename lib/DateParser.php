<?php

use DateParser\Sampler;
use DateParser\SourceType\Factory as SourceTypeFactory;

class DateParser {
    private static $month_names =
        array("january", "february", "march", "april", "may", "june", "july", "august",
            "september", "october", "november", "december");
    private static $short_month_names =
        array("jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec");

    public function render_sampler() {
        $sampler = new Sampler();
        return $sampler->render();
    }

    public static function parse_date($source_date) {
        $result = new stdClass();

        $parse_object = SourceTypeFactory::get_sourcetype_object($source_date);
        $parse_object->parse();
        $result->original = $source_date;
        $result->parsed = $parse_object->get_string_representation();
        $result->certainty = $parse_object->get_certainty();
        return $result;
    }

    public static function is_month_name($string) {
        return in_array(strtolower($string), self::$month_names);
    }

    public static function is_short_month_name($string) {
        return in_array(strtolower($string), self::$short_month_names);
    }

    public static function get_month_number($month_string) {
        $month_index = array_search(strtolower($month_string), self::$month_names);
        return ++$month_index;
    }

    public static function get_short_month_number($short_month_string) {
        $month_index = array_search(strtolower($short_month_string), self::$short_month_names);
        return ++$month_index;
    }

    public static function is_valid_year_number($year) {
        if (!ctype_digit($year)) return false;
        if (strlen($year) > 4) return false;
        return true;
    }

    public static function is_valid_month_number($month) {
        if (!ctype_digit($month)) return false;
        if ($month > 12) return false;
        return true;
    }

    public static function is_valid_day_number($day) {
        if (!ctype_digit($day)) return false;
        if ($day > 31) return false;
        return true;
    }

    public static function is_day_number_for_sure($day) {
        if (!ctype_digit($day)) return false;
        if ($day > 12) return true;
        return false;
    }

    public static function find_separator_from_subset($separator_subset, $haystack) {
        $count = 0;
        foreach($separator_subset as $separator) {
            if (strpos($haystack, $separator)) {
                $final_separator = $separator;
                $count++;
            }
        }

        if ($count!=1) return false;
        return $final_separator;
    }
}

?> 