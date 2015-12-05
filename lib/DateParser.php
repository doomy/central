<?php

use DateParser\Sampler;
use DateParser\SourceType\Factory as SourceTypeFactory;

class DateParser {
    private static $month_names =
        array("january", "february", "march", "april", "may", "june", "july", "august",
            "september", "october", "november", "december");
    private static $short_month_names =
        array("jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec");
    private static $illegal_characters = array(",", "?", "!", "[", "]");
    private static $ambiguous_keywords = array(
        "circa", "around", "about", "late", "early", "before", "after",
        "baptized", "probably", "uncertain", "bapt.", "beginning"
    );

    public function render_sampler() {
        $sampler = new Sampler();
        return $sampler->render();
    }

    public static function parse_date($source_date) {
        $result = new stdClass();

        $raw_date = self::purify_source_date($source_date);
        $parse_object = SourceTypeFactory::get_sourcetype_object($raw_date);
        $parse_object->parse();
        $result->original = $source_date;
        $result->parsed = $parse_object->get_string_representation();
        $result->certainty = $parse_object->get_certainty();
        return $result;
    }

    public static function purify_source_date($source_date) {
        $raw_date = trim($source_date);
        foreach (self::$illegal_characters as $illegal_character) {
            $raw_date = str_replace($illegal_character, "", $raw_date);
        }
        $raw_date = str_replace(" of ", " ", $raw_date);
        $raw_date = str_replace("&nbsp;", " ", $raw_date);
        return $raw_date;
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
        if (!is_numeric($year)) return false;
        if (strlen($year) > 4) return false;
        return true;
    }

    public static function is_valid_month_number($month) {
        if (!is_numeric($month)) return false;
        if ($month > 12) return false;
        return true;
    }

    public static function is_valid_day_number($day) {
        if (!is_numeric($day)) return false;
        if ($day > 31) return false;
        return true;
    }

    public static function is_day_number_for_sure($day) {
        if (!is_numeric($day)) return false;
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

    public static function contains_a_month_name($list) {
        foreach($list as $string) {
            if (self::is_valid_month_name($string)) {
                return $string;
            }
        }

        return false;
    }

    public static function is_valid_month_name($month_name) {
        return in_array(strtolower($month_name), self::$month_names);
    }

    public static function get_nth_number($string) {
        $string = str_replace("st", "", $string);
        $string = str_replace("nd", "", $string);
        $string = str_replace("rd", "", $string);
        $string = str_replace("th", "", $string);
        return is_numeric($string) ? $string : false;
    }

    public static function get_day_from_nth_day($day) {
        $day = strtolower($day);
        $day = self::get_nth_number($day);
        return self::is_valid_day_number($day) ? $day : false;

    }

    public static function strip_invalid_parts($parts) {
        $stripped_parts = array();
        foreach($parts as $part) {
            if (is_numeric($part) || self::is_valid_month_name($part))
                $stripped_parts[] = $part;
        }
        return $stripped_parts;
    }

    public static function contains_ambiguous_keyword($raw_date) {
        $raw_date_lower = strtolower($raw_date);
        foreach (self::$ambiguous_keywords as $keyword) {
            if (strpos($raw_date_lower, $keyword) > -1 ) return true;
        }
        return false;
    }

    public static function strip_ambiguous_parts($parts) {
        $new_parts = array();
        foreach ($parts as $part) {
            if (!in_array($part, self::$ambiguous_keywords))
                $new_parts[] = $part;
        }
        return $new_parts;
    }

}

?> 