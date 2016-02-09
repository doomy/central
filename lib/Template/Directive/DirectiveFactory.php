<?php

namespace Template\Directive;

use Template\Directive\DirectiveParser;
use Template\Directive\IncludeDirective;
use Template\Directive\ForeachDirective;
use Template\Directive\IfDirective;
use Template\Directive\RenderComponentChildren;
use Template\Directive\RenderChildComponentByName;


class DirectiveFactory {
    private static $nestedDirectiveNames = array('foreach', 'if');

    public static function get_directive($directive_code, $component = null) {
        $directive_name = DirectiveParser::get_directive_name($directive_code);
        switch($directive_name) {
            case 'include':
                $directive = new IncludeDirective($component);
                break;
            case 'foreach':
                $directive = new ForeachDirective();
                break;
            case 'if':
                $directive = new IfDirective($component);
                break;
			case 'render_component_children':
				$directive = new RenderComponentChildren($component);
				break;
            case 'render_child_component_by_name':
                $directive = new RenderChildComponentByName($component);
                break;
        }

        self::init_directive($directive, $directive_code);
        return $directive;
    }

    public static function init_directive($directive, $directive_code) {
        $directive_data = DirectiveParser::get_directive_data($directive_code);
        $directive_name = $directive_data['directive_name'];
        $directive_parameters = $directive_data['directive_parameters'];
        $directive_contents = self::is_nested_directive($directive_name) ? $directive_data['directive_contents'] : null;
        $directive->set_parameters($directive_parameters);
        $directive->set_contents($directive_contents);
    }

    public static function is_nested_directive($directive_name) {
        return (in_array($directive_name, self::$nestedDirectiveNames));
    }
}

?> 