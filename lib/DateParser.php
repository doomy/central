<?php

use DateParser\Sampler;
use DateParser\SourceType\Factory as SourceTypeFactory;

class DateParser {
    private static $month_names =
        array("january", "february", "march", "april", "may", "june", "july", "august",
            "september", "october", "november", "december");

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

    public static function get_month_number($month_string) {
        $month_index = array_search(strtolower($month_string), self::$month_names);
        return ++$month_index;
    }

    public static function is_valid_year_number($year) {
        if (!ctype_digit($year)) return false;
        if (strlen($year) > 4) return false;
        return true;
    }

    public static function is_valid_day_number($day) {
        if (!ctype_digit($day)) return false;
        if ($day > 31) return false;
        return true;
    }
}

?> 