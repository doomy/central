<?php

namespace Template\Directive;

use Template;

class IfDirective extends Directive {
    public function render($template_vars) {
        $output = "";
        $condition = $this->parameters[0];
        if ($condition) {
            $template = new Template(null, $template_vars);
            $output = $template->process_output($this->contents);
        }
        return $output;
    }

}

?> 