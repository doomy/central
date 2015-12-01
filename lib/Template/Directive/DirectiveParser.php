<?php

namespace Template\Directive;

use Template\Directive\DirectiveFactory;


class DirectiveParser {
    const DIRECTIVE_START = '<<<';
    const DIRECTIVE_END = '>>>';
    const VARIABLE_DELIMITER = '$$';
    const ARG_DELIMITER = '|';

    public static function get_directive_name($raw_directive) {
        $stripped_code = str_replace(self::DIRECTIVE_START, '', $raw_directive);
        $separator = self::get_directive_name_separator($stripped_code);
        $parts = explode($separator, $stripped_code);
        return $parts[0];
    }

    public static function get_directive_data($directive_code) {
        $directive_name = self::get_directive_name($directive_code);

        $directive_data = array(
            'directive_name' => $directive_name
        );

        if (DirectiveFactory::is_nested_directive($directive_name)) {
            $directive_data = array_merge($directive_data, self::get_nested_directive_data($directive_code, $directive_name));
        }
        else {
            $directive_data['directive_parameters'] = self::get_simple_directive_parameters($directive_code);
        }

        return $directive_data;
    }

    private function get_directive_name_separator($stripped_code) {
        $first_delimiter_position = strpos($stripped_code, self::ARG_DELIMITER);
        $first_directive_end_position = strpos($stripped_code, self::DIRECTIVE_END);

        if(!$first_delimiter_position) $separator = self::DIRECTIVE_END;
        else if ($first_delimiter_position > $first_directive_end_position) $separator = self::DIRECTIVE_END;
        else $separator = self::ARG_DELIMITER;



        return $separator;
    }

    private static function get_nested_directive_data($directive_code, $directive_name) {
        $directive_wrapper_start = self::get_nested_directive_wrapper_start($directive_code);
        $directive_wrapper_end = self::DIRECTIVE_START . '/' . $directive_name . self::DIRECTIVE_END;

        $directive_data['directive_parameters'] = self::get_simple_directive_parameters($directive_wrapper_start);
        $directive_data['directive_contents'] = self::get_nested_directive_contents($directive_code, $directive_wrapper_start, $directive_wrapper_end);

        return $directive_data;
    }

    private function get_nested_directive_wrapper_start($directive_code) {
        $first_tag_closing_position = strpos($directive_code, self::DIRECTIVE_END);
        $endpos = $first_tag_closing_position + strlen(self::DIRECTIVE_END);
        return substr($directive_code, 0, $endpos);
    }

    private static function get_simple_directive_parameters($directive_code) {
        $directive_code = trim($directive_code, '<');
        $directive_code = trim($directive_code, '>');
        $parts = explode("|", $directive_code);
        array_shift($parts); // first part is directive name
        return $parts;
    }

    private static function get_nested_directive_contents($directive_code, $directive_wrapper_start, $directive_wrapper_end) {
        $startpos = strpos($directive_code, $directive_wrapper_start) + strlen($directive_wrapper_start);
        $endpos = strpos($directive_code, $directive_wrapper_end);
        $length = $endpos - $startpos;
        return substr($directive_code, $startpos,$length);
    }

}

?> 