<?php

namespace Template\Directive;

use Template\Directive\IncludeDirective;


class DirectiveFactory {
    public static function get_directive($directive_code) {
        $directive_code = trim($directive_code, '<');
        $directive_code = trim($directive_code, '>');
        $parts = explode("|", $directive_code);
        if ($parts[0] == 'include') {
            return new IncludeDirective($parts[1]);
        }
    }
}

?> 