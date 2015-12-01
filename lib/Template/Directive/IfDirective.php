<?php

namespace Template\Directive;

use Template;
use Template\Directive\DirectiveParser;

class IfDirective extends Directive {
    public function render($template_vars) {
        $output = "";
        $else_separator = DirectiveParser::DIRECTIVE_START . 'else' . DirectiveParser::DIRECTIVE_END;
        $parts = explode($else_separator, $this->contents);

        $condition = $this->process_condition($this->parameters[0]);
        $template = new Template(null, $template_vars);
        if ($condition) {
            $output = $template->process_output($parts[0]); // before else
        }
        else if (isset($parts[1])) {
            $output = $template->process_output($parts[1]); // after else
        }
        return $output;
    }

    private function process_condition($raw_condition) {
        $equation_position = strpos($raw_condition, '==');
        if (!$equation_position) return $raw_condition;

        $parts = explode("==", $raw_condition);
        return $parts[0]==$parts[1];
    }

}

?> 