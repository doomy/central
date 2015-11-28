<?php

namespace Template\Directive;

use Template\Directive\IncludeDirective;


class DirectiveFactory {
    public static function get_directive($directive_code) {
        list($directive_name, $directive_parameters) = self::get_directive_data($directive_code);

        switch($directive_name) {
            case 'include':
                $filename = $directive_parameters[0];
                return new IncludeDirective($filename);
                break;
            case 'foreach':
        }
    }

    private static function get_directive_data($directive_code) {
        $directive_code = trim($directive_code, '<');
        $directive_code = trim($directive_code, '>');
        $parts = explode("|", $directive_code);
        $directive_name = array_shift($parts);
        $directive_parameters = $parts;
        return array($directive_name, $directive_parameters);
    }
}

?> 